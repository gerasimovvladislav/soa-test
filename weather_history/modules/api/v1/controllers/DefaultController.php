<?php

declare(strict_types=1);

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\controllers\actions\GetByDateAction;
use app\modules\api\v1\controllers\actions\GetHistoryAction;
use JsonRpc2\Controller;

/**
 * Class DefaultController
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class DefaultController extends Controller
{
	const ACTION_GET_BY_DATE = "weather.getByDate";
	const ACTION_GET_HISTORY = "weather.getHistory";

	public function actions()
	{
		return [
			static::ACTION_GET_BY_DATE => GetByDateAction::class,
			static::ACTION_GET_HISTORY => GetHistoryAction::class,
		];
	}

//	/**
//	 * Renders the index view for the module
//	 * @return array
//	 */
//	public function actionGetByDate($date)
//	{
//		return [
//			'message' => $date,
//		];
//	}
}
