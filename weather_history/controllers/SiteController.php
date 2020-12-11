<?php

declare(strict_types=1);

namespace app\controllers;

use yii\filters\VerbFilter;
use app\controllers\actions\IndexAction;
use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * Контроллер визуальной части сайта.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class SiteController extends Controller
{
	const ACTION_ERROR = 'error';
	const ACTION_INDEX = 'index';

	/**
	 * {@inheritdoc}
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'weather' => ['post'],
				],
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function actions()
	{
		return [
			static::ACTION_ERROR => ErrorAction::class,
			static::ACTION_INDEX => IndexAction::class,
		];
	}

}
