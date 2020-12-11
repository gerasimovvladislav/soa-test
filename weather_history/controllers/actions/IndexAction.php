<?php

declare(strict_types=1);

namespace app\controllers\actions;

use yii\base\Action;
use yii\web\Response;

/**
 * Эксшн главной страницы.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class IndexAction extends Action
{
	public function __construct($id, $controller, $config = [])
	{
		parent::__construct($id, $controller, $config);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return Response
	 */
	public function run(): Response
	{
		return $this->controller->asJson([]);
	}
}
