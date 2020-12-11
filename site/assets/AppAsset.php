<?php

declare(strict_types=1);

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class AppAsset extends AssetBundle
{
	/** @var string */
	public $basePath = '@webroot';

	/** @var string */
	public $baseUrl = '@web';

	/** @var string[] */
	public $css = [
		'css/site.css',
	];

	/** @var string[] */
	public $js = [];

	/** @var array */
	public $depends = [
		YiiAsset::class,
		BootstrapAsset::class,
	];
}
