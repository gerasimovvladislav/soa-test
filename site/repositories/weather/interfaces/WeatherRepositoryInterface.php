<?php

declare(strict_types=1);

namespace app\repositories\weather\interfaces;

/**
 * Интерфейс репозитория для погоды.
 */
interface WeatherRepositoryInterface
{
	const URL_API = "http://weather_history/api/v1/";
	const COUNT_DEFAULT_LAST_DAYS = 30;
	const ATTR_RESPONSE_RESULT = 'result';

	/**
	 * string $date
	 * bool $limit
	 * @return array|array[]
	 */
	public function getFrom(string $date, bool $limit = false): array;
}