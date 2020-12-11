<?php

declare(strict_types=1);

namespace app\repositories\weather\request;

/**
 * Class WeatherHistoryRequestParameters
 */
class WeatherHistoryRequestParameters implements WeatherRequestParametersInterface
{
	/** @var int */
	public $lastDays;
	const ATTR_LAST_DAYS = 'lastDays';

	const METHOD_NAME = 'weather.getHistory';

	/**
	 * @return int[]
	 */
	public function getData(): array
	{
		return [
			static::ATTR_LAST_DAYS => $this->lastDays,
		];
	}

	/**
	 * @return string
	 */
	public function getMethod(): string
	{
		return static::METHOD_NAME;
	}
}