<?php

declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\RefHistory;
use DateTimeImmutable;

/**
 * Interface HistoryRepositoryInterface
 */
interface HistoryRepositoryInterface
{
	/**
	 * @param DateTimeImmutable $date
	 * @return RefHistory|null
	 */
	public function getByDate(DateTimeImmutable $date): ?RefHistory;

	/**
	 * @param DateTimeImmutable $date
	 * @return RefHistory[]
	 */
	public function getFromDate(DateTimeImmutable $date): array;
}