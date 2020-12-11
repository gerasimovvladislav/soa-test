<?php

declare(strict_types=1);

namespace app\repositories\weather;

use app\components\api\interfaces\ApiModuleInterface;
use app\components\api\interfaces\ApiModuleJsonRPC2Interface;
use app\exceptions\FiledGetHistoryException;
use app\helpers\DateHelper;
use app\repositories\weather\interfaces\WeatherRepositoryInterface;
use app\repositories\weather\request\WeatherDayRequestParameters;
use app\repositories\weather\request\WeatherHistoryRequestParameters;
use app\repositories\weather\request\WeatherRequestParametersInterface;
use yii\helpers\Json;

/**
 * Репозиторий для информации о погоде.
 */
class WeatherRepository implements WeatherRepositoryInterface
{
	/** @var ApiModuleInterface Модуль API. */
	private $apiModule;

	/**
	 * WeatherRepository constructor.
	 * @param ApiModuleInterface $apiModule
	 */
	public function __construct(ApiModuleInterface $apiModule)
	{
		$this->apiModule = $apiModule;
	}

	/**
	 * string $date
	 * bool $limit
	 * @return array|array[]
	 */
	public function getFrom(string $date, bool $limit = false): array
	{
		/** @var $request ApiModuleJsonRPC2Interface */
		$request = $this->apiModule;
		$request->setUrl(static::URL_API);
		$params = $this->buildParameters($date, $limit);
		$request->setParams($params->getData());
		$request->setMethod($params->getMethod());

		$response = $request->send();
		$response = $this->handleResponse($response);
		$data = $this->getDataFromResponse($response);

		return $data;
	}

	/**
	 * string $date
	 * bool $from
	 * @return WeatherRequestParametersInterface
	 */
	private function buildParameters(string $date, bool $from = false): WeatherRequestParametersInterface
	{
		if (false !== $from) {
			$params = new WeatherDayRequestParameters();
			$params->date = $date;
		} else {
			$params = new WeatherHistoryRequestParameters();
			$lastDays = DateHelper::from($date)->diff(DateHelper::current())->days ?? 0;

			$params->lastDays = $lastDays;
		}

		return $params;
	}

	/**
	 * @param $response
	 * @return array
	 * @throws FiledGetHistoryException
	 */
	private function handleResponse($response): array
	{
		try {
			$result = Json::decode($response);
		} catch (\Exception $e) {
			throw new FiledGetHistoryException(Yii::t("ПРоизошла ошибка"));
		}

		return $result;
	}

	/**
	 * @param array $response
	 * @return array
	 */
	private function getDataFromResponse(array $response): array
	{
		$result = [];

		if (false !== isset($response[static::ATTR_RESPONSE_RESULT]) && is_array($response[static::ATTR_RESPONSE_RESULT])) {
			$result = $response[static::ATTR_RESPONSE_RESULT];
		}

		return $result;
	}
}