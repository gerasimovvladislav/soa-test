<?php

declare(strict_types=1);

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class AppController
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class AppController extends Controller
{
	/** @var string[] */
	public $writablePaths = [
		'@app/runtime',
		'@app/web/assets',
	];

	/** @var string[] */
	public $executablePaths = [
		'@app/yii',
	];

	/** @var string[] */
	public $generateKeysPaths = [
		'@app/.env',
	];

	/**
	 * Запускаем действия для установки
	 * @throws \yii\base\InvalidRouteException
	 * @throws \yii\console\Exception
	 */
	public function actionSetup()
	{
		$this->runAction('set-writable', ['interactive' => $this->interactive]);
		$this->runAction('set-executable', ['interactive' => $this->interactive]);
		$this->runAction('set-keys', ['interactive' => $this->interactive]);
		\Yii::$app->runAction('migrate/up', ['interactive' => $this->interactive]);
	}

	/**
	 * Устанавливаем необходимые права
	 */
	public function actionSetWritable()
	{
		$this->setWritable($this->writablePaths);
	}

	/**
	 * Назначаем исполняемый файл
	 */
	public function actionSetExecutable()
	{
		$this->setExecutable($this->executablePaths);
	}

	/**
	 * Устанавливаем ключи
	 */
	public function actionSetKeys()
	{
		$this->setKeys($this->generateKeysPaths);
	}

	/**
	 * Устанавливаем необходимые права по путям
	 * @param array $paths Пути
	 */
	public function setWritable(array $paths)
	{
		foreach ($paths as $writable) {
			$writable = Yii::getAlias($writable);
			Console::output("Setting writable: {$writable}");
			@chmod($writable, 0777);
		}
	}

	/**
	 * Делаем файлы исполняемыми
	 * @param array $paths Пути
	 */
	public function setExecutable(array $paths)
	{
		foreach ($paths as $executable) {
			$executable = Yii::getAlias($executable);
			Console::output("Setting executable: {$executable}");
			@chmod($executable, 0755);
		}
	}

	/**
	 * Устанавливаем ключи
	 * @param $paths Пути
	 */
	public function setKeys(array $paths)
	{
		foreach ($paths as $file) {
			$file = Yii::getAlias($file);
			Console::output("Generating keys in {$file}");
			$content = file_get_contents($file);
			$content = preg_replace_callback('/<generated_key>/', function () {
				$length = 32;
				$bytes = openssl_random_pseudo_bytes(32);

				return strtr(substr(base64_encode($bytes), 0, $length), '+/', '_-');
			}, $content);
			file_put_contents($file, $content);
		}
	}
}