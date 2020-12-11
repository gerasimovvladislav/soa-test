<?php

declare(strict_types=1);

namespace app\modules\api\controllers;

use yii\rest\Controller;

/**
 * Default controller for the `api` module
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class DefaultController extends Controller
{
	/**
	 * Renders the index view for the module
	 * @return string
	 */
	public function actionIndex(): array
	{
		return [
			'message' => 'api_module',
		];
	}
}
