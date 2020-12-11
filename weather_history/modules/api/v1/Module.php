<?php

declare(strict_types=1);

namespace app\modules\api\v1;

use Yii;

/**
 * v1 module definition class
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class Module extends \yii\base\Module
{
	/**
	 * @inheritdoc
	 */
	public $controllerNamespace = 'app\modules\api\v1\controllers';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		Yii::$app->user->enableSession = false;
	}
}
