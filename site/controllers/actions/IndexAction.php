<?php

declare(strict_types=1);

namespace app\controllers\actions;

use app\helpers\DateHelper;
use app\models\weather\form\GetWeatherByDateForm;
use app\services\weather\interfaces\WeatherServiceInterface;
use Yii;
use yii\base\Action;
use yii\data\ArrayDataProvider;
use yii\web\Request;

/**
 * Эксшн главной страницы.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class IndexAction extends Action
{
	const ATTR_DATA = 'data';
	const ATTR_FORM = 'form';
	const ATTR_MODEL = 'model';
	const ATTR_HISTORY = 'history';
	const ATTR_PROVIDER = 'provider';
	const ATTR_TEMPERATURE = 'temperature';

	/** @var array */
	private $data = [];

	/** @var WeatherServiceInterface Сервис для работы с данными о погоде. */
	private $weatherService;

	public function __construct($id, $controller, WeatherServiceInterface $weatherService, $config = [])
	{
		parent::__construct($id, $controller, $config);

		$this->weatherService = $weatherService;
		$this->data = [
			static::ATTR_FORM => new GetWeatherByDateForm(),
			static::ATTR_HISTORY => $this->weatherService->getByLastMonth(),
		];
	}

	/**
	 * Запуск действия.
	 * @return string
	 */
	public function run(Request $request): string
	{
		$this->setTemperatureAtDateIfRequested($request->post());
		return $this->renderPage('index');
	}

	/**
	 * @param string $view
	 * @return string
	 */
	private function renderPage(string $view)
	{
		$dataProvider = new ArrayDataProvider([
			'allModels' => $this->data[static::ATTR_HISTORY],
		]);

		return $this->controller->render($view, [
			static::ATTR_DATA => $this->data,
			static::ATTR_PROVIDER => $dataProvider,
		]);
	}

	private function setTemperatureAtDateIfRequested($post)
	{
		$form = new GetWeatherByDateForm();
		if (false === empty($post) && $form->load($post)) {
			if ($form->validate()) {
				$date = DateHelper::from($form->date);
				$temperature = $this->weatherService->getByDate($date);
				$this->data[static::ATTR_TEMPERATURE] = $temperature;
			} else {
				foreach ($form->getErrors() as $error) {
					Yii::$app->session->setFlash('error', array_pop($error));
				}
			}
		}
	}
}
