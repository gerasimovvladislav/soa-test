<?php

declare(strict_types=1);

namespace app\repositories;

use app\models\RefHistory;
use app\repositories\interfaces\HistoryRepositoryInterface;
use DateTimeImmutable;

/**
 * Class HistoryRepository
 */
class HistoryRepository implements HistoryRepositoryInterface
{
	/**
	 * @param DateTimeImmutable $date
	 * @return RefHistory|null
	 */
	public function getByDate(DateTimeImmutable $date): ?RefHistory
	{
		$query = RefHistory::find()
			->where([RefHistory::ATTR_DATE_AT => $date->format("Y-m-d")]);
		$result = $query->one();

		return $result;
	}

	/**
	 * @param DateTimeImmutable $date
	 * @return RefHistory[]
	 */
	public function getFromDate(DateTimeImmutable $date): array
	{
		$query = RefHistory::find()
			->where([">=", RefHistory::ATTR_DATE_AT, $date->format("Y-m-d")])
			->orderBy([RefHistory::ATTR_DATE_AT => SORT_DESC]);
		$result = $query->all();

		return $result;
	}
}