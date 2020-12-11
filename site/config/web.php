<?php

declare(strict_types=1);

use app\components\api\ApiModuleAbstractFactory;
use app\components\api\interfaces\ApiModuleAbstractFactoryInterface;
use app\repositories\weather\interfaces\WeatherRepositoryInterface;
use app\repositories\weather\WeatherRepository;
use app\services\weather\interfaces\WeatherServiceInterface;
use app\services\weather\WeatherService;
use Graze\GuzzleHttp\JsonRpc\ClientInterface;
use yii\di\Container;

$params = require(__DIR__ . '/params.php');
$routes = require(__DIR__ . '/routes.php');
$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => [
		'log',
	],
	'components' => [
		'response' => [
			'class' => 'yii\web\Response',
			'on beforeSend' => function ($event) {
				$response = $event->sender;

				/** @var \yii\web\Response $response */
				if (Yii::$app->response->format != 'html' && null !== $response->data) {
					$response->data = [
						'success' => $response->isSuccessful,
						'data' => $response->data,
					];
					$response->statusCode = 200;
				}
			},
		],
		'request' => [
			'class' => '\yii\web\Request',
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			],
			'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
			'enableCookieValidation' => false,
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\RefUser',
			'enableAutoLogin' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => $routes,
		],

	],
	'params' => $params,
	'container' => [
		'definitions' => [
			ApiModuleAbstractFactoryInterface::class => ApiModuleAbstractFactory::class,
			WeatherRepositoryInterface::class => function (Container $container) {
				$apiModuleFactory = $container->get(ApiModuleAbstractFactoryInterface::class);
				$apiModule = $apiModuleFactory->createForJsonRPC2();

				return new WeatherRepository($apiModule);
			},
			WeatherServiceInterface::class => function (Container $container) {
				return new WeatherService($container->get(WeatherRepositoryInterface::class));
			}
		],
	],
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => ['*'],
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
		'generators' => [
			'crud' => ['class' => 'mdm\gii\generators\crud\Generator'],
			'mvc' => ['class' => 'mdm\gii\generators\mvc\Generator'],
			'migration' => ['class' => 'mdm\gii\generators\migration\Generator'],
		],
		'allowedIPs' => ['*'],
	];
}

return $config;
