<?php

use yii\di\Container;
use app\repositories\interfaces\HistoryRepositoryInterface;
use app\repositories\HistoryRepository;
use app\services\interfaces\HistoryServiceInterface;
use app\services\HistoryService;

$params = require(__DIR__ . '/params.php');
$routes = require(__DIR__ . '/routes.php');
$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'bootstrap' => [
		'log',
	],
	'modules' => [
		'api' => [
			'class' => 'app\modules\api\Module',
			'modules' => [
				'v1' => [
					'class' => 'app\modules\api\v1\Module',
				],
			],
		],
	],
	'components' => [
		'response' => [
			'class' => 'yii\web\Response',
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
		'db' => require(__DIR__ . '/db.php'),
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => $routes,
		],

	],
	'params' => $params,
	'container' => [
		'definitions' => [
			HistoryRepositoryInterface::class => HistoryRepository::class,
			HistoryServiceInterface::class => function (Container $container) {
				return new HistoryService(
					$container->get(HistoryRepositoryInterface::class)
				);
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
