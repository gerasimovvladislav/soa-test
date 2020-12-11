<?php

declare(strict_types=1);

namespace app\modules\api\v1\controllers\actions;

use app\helpers\DateHelper;
use app\services\interfaces\HistoryServiceInterface;
use yii\base\Action;

/**
 * Class GetByDateAction
 */
class GetHistoryAction extends Action
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
	 * @param $lastDays
	 */
	public function run($lastDays)
	{
		$dateFrom = DateHelper::current()->modify("-$lastDays days")->format("Y-m-d");
		return $this->historyService->getFromDate($dateFrom);
	}
}