<?php

declare(strict_types=1);

namespace app\components\api;

use app\components\api\interfaces\ApiModuleInterface;
use app\components\api\interfaces\ApiModuleJsonRPC2Interface;
use app\exceptions\FiledGetHistoryException;
use app\exceptions\IncorrectDataForBuildApiRequestException;
use Graze\GuzzleHttp\JsonRpc\Client;
use GuzzleHttp\Exception\RequestException;
use Yii;
use yii\helpers\Json;

/**
 * Клас для работы с API спецификации Json-RPC v2
 *	(прим. {"jsonrpc": "2.0", "method": "weather.getHistory", "params": {"lastDays": 30}, "id": 1})
 */
class ApiModuleJsonRPC2 implements ApiModuleInterface, ApiModuleJsonRPC2Interface
{
	const ATTR_ID = 'id';

	/** @var string */
	private $url;

	/** @var string */
	private $method;

	/** @var array */
	private $params = [];

	/** @var int */
	private $id;

	/**
	 * Устанавливает URL для отправки запроса.
	 * @param string $url
	 */
	public function setUrl(string $url): void
	{
		$this->url = $url;
	}

	public function setMethod(string $methodName): void
	{
		$this->method = $methodName;
	}

	/**
	 * Устанавливает параметры для запроса.
	 * @param array $params
	 */
	public function setParams(array $params): void
	{
		foreach ($params as $field => $value) {
			$this->params[$field] = $value;
		}
	}

	/**
	 * Отправляет запрос
	 * @return mixed
	 * @throws IncorrectDataForBuildApiRequestException
	 */
	public function send()
	{
		$this->setRandId();

		if ($this->validateData()) {
			$client = Client::factory($this->url);

			$request = $client->request($this->id, $this->method, $this->params);

			try {
				$result = $client->send($request);

				return $result->getBody()->getContents();
			} catch (RequestException $e) {
				throw new FiledGetHistoryException($e->getResponse()->getRpcErrorMessage());
			}
		}

		throw new IncorrectDataForBuildApiRequestException(Yii::t('app', "Данные некорректны."));
	}

	/**
	 * {@inheritDoc}
	 */
	private function setRandId(): void
	{
		$this->id = rand(0, 9999999);
	}

	/**
	 * Проверяем валидность данных для составления запроса.
	 * @return string|null
	 */
	private function validateData(): bool
	{
		return (null !== $this->url) && (null !== $this->method);
	}
}