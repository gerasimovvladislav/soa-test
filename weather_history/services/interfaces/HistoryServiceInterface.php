<?php

declare(strict_types=1);

namespace app\services\interfaces;

use app\helpers\DateHelper;

/**
 * Interface HistoryServiceInterface
 */
interface HistoryServiceInterface
{
	/**
	 * @param string $date
	 * @return RefHistory|null
	 */
	public function getByDate(string $date);

	/**
	 * @param string $date
	 * @return RefHistory[]
	 */
	public function getFromDate(string $date);
}