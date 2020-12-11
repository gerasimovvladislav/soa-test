<?php

declare(strict_types=1);

namespace app\modules\api\v1\components;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;

/**
 * Class RestController
 * @package app\modules\api\v1\components
 */
class RestController extends Controller
{
	/**
	 * @return array|array[]
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
			'class' => CompositeAuth::className(),
			'authMethods' => [
				HttpBasicAuth::className(),
				HttpBearerAuth::className(),
				QueryParamAuth::className(),
			],
		];

		return $behaviors;
	}

}