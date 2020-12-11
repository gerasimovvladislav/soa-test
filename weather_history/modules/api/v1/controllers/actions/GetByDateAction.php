<?php

declare(strict_types=1);

namespace app\modules\api\v1\controllers\actions;

use app\services\interfaces\HistoryServiceInterface;
use yii\base\Action;

/**
 * Class GetByDateAction
 */
class GetByDateAction extends Action
{
	/** @var HistoryServiceInterface */
	private $historyService;

	/**
	 * GetByDateAction constructor.
	 * @param $id
	 * @param $controller
	 * @param array $config
	 */
	public function __construct($id, $controller, HistoryServiceInterface $historyService, $config = [])
	{
		parent::__construct($id, $controller, $config);
		$this->historyService = $historyService;
	}

	/**
	 * @param $date
	 */
	public function run($date)
	{
		return $this->historyService->getByDate($date);
	}
}