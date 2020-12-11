<?php

declare(strict_types=1);

namespace app\repositories\weather\request;

/**
 * Class WeatherDayRequestParameters
 */
class WeatherDayRequestParameters implements WeatherRequestParametersInterface
{
	/** @var string */
	public $date;
	const ATTR_DATE = 'date';

	const METHOD_NAME = 'weather.getByDate';

	/**
	 * @return string[]
	 */
	public function getData(): array
	{
		return [
			static::ATTR_DATE => $this->date,
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