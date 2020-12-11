<?php

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 * Note: To avoid "Multiple Implementations" PHPStorm warning and make autocomplete faster
 * exclude or "Mark as Plain Text" vendor/yiisoft/yii2/Yii.php file
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication the application instance
     */
    public static $app;
}
/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property yii\web\UrlManager $urlManagerFrontend UrlManager for frontend application.
 * @property yii\web\UrlManager $urlManagerBackend UrlManager for backend application.
 * @property yii\web\UrlManager $urlManagerStorage UrlManager for storage application.
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * RefUser component
 * Include only Web application related components here
 *
 * @property \app\models\RefUser $identity RefUser model.
 * @method \app\models\RefUser getIdentity() returns RefUser model.
 */
class User extends \yii\web\User
{
}