<?php

declare(strict_types=1);

namespace app\helpers;

use DateTimeImmutable;
use DateTimeZone;
use Yii;

/**
 * Class DateHelper
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class DateHelper
{
	/**
	 * Получить объект \DateTimeImmutable текущего времени в заданной таймзоне
	 *
	 * @param string|null $timezone Код часового пояса | смещение, если нет - используется текущая таймзона из Yii
	 * @return DateTimeImmutable
	 */
	public static function current(?string $timezone = null): DateTimeImmutable
	{
		return static::from('now', $timezone);
	}

	/**
	 * Получить объект \DateTimeImmutable конкретного переданного времени в заданной таймзоне
	 *
	 * @param string $time Строка времени
	 * @param string|null $tz Код часового пояса | смещение, если нет - используется текущая таймзона из Yii
	 * @return DateTimeImmutable
	 */
	public static function from(string $time, ?string $tz = null): DateTimeImmutable
	{
		return new DateTimeImmutable($time, new DateTimeZone($tz ?? Yii::$app->timezone));
	}
}
