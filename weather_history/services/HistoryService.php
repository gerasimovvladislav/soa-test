<?php

declare(strict_types=1);

namespace app\services;

use app\helpers\DateHelper;
use app\models\RefHistory;
use app\repositories\interfaces\HistoryRepositoryInterface;
use app\services\interfaces\HistoryServiceInterface;

/**
 * Class HistoryService
 */
class HistoryService implements HistoryServiceInterface
{
	/** @var HistoryRepositoryInterface */
	private $historyRepository;

	public function __construct(HistoryRepositoryInterface $historyRepository)
	{
		$this->historyRepository = $historyRepository;
	}

	public function getByDate(string $date)
	{
		$dateObj = DateHelper::from($date);
		return $this->historyRepository->getByDate($dateObj);
	}

	public function getFromDate(string $date)
	{
		$dateObj = DateHelper::from($date);
		return $this->historyRepository->getFromDate($dateObj);
	}
}