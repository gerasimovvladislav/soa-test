<?php

declare(strict_types=1);

namespace app\modules\api;

use Exception;
use Yii;
use yii\web\ErrorHandler;
use yii\web\Response;

/**
 * Class ApiErrorHandler
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class ApiErrorHandler extends ErrorHandler
{
	/**
	 * @param Exception $exception Объект исключения
	 */
	protected function renderException($exception)
	{
		if (Yii::$app->has('response')) {
			$response = Yii::$app->getResponse();
		} else {
			$response = new Response();
		}

		$response->data = $this->convertExceptionToArray($exception);
		$response->setStatusCode($this->getCode($exception));
		$response->send();
	}

	/**
	 * @param Exception $exception Объект исключения
	 * @return array
	 */
	protected function convertExceptionToArray($exception): array
	{
		return [
			'code' => $this->getCode($exception),
			'message' => $exception->getMessage(),
		];
	}


	/**
	 * @param $exception
	 * @return int
	 */
	private function getCode($exception): int
	{
		if (empty($exception->statusCode)) {
			$code = 500;
		} else {
			$code = $exception->statusCode;
		}

		return $code;
	}
}