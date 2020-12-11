<?php

declare(strict_types=1);

namespace app\services\weather\interfaces;

use app\helpers\DateHelper;
use app\models\weather\dto\WeatherAtDateDto;
use DateTimeImmutable;

/**
 * Interface WeatherServiceInterface
 */
interface WeatherServiceInterface
{
	/**
	 * @return WeatherAtDateDto[]
	 */
	public function getByLastMonth(): array;

	/**
	 * @return WeatherAtDateDto
	 */
	public function getByDate(DateTimeImmutable $date): WeatherAtDateDto;
}