<?php

declare(strict_types=1);

namespace app\models\weather\dto;

/**
 * DTO для записи о погоде.
 */
class WeatherAtDateDto
{
	/** @var string $temp */
	public $temp;
	const ATTR_TEMP = 'temp';

	/** @var string $date */
	public $date;
	const ATTR_DATE = 'date_at';
}