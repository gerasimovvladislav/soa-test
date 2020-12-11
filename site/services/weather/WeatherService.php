<?php

declare(strict_types=1);

namespace app\services\weather;

use app\helpers\DateHelper;
use app\models\weather\dto\WeatherAtDateDto;
use app\repositories\weather\interfaces\WeatherRepositoryInterface;
use app\services\weather\interfaces\WeatherServiceInterface;
use DateTimeImmutable;

/**
 * Сервис для работы с данными о погоде.
 */
class WeatherService implements WeatherServiceInterface
{
	/** @var WeatherRepositoryInterface Репозиторий для получения погоды. */
	private $weatherRepository;

	/**
	 * WeatherService constructor.
	 * @param WeatherRepositoryInterface $weatherRepository
	 */
	public function __construct(WeatherRepositoryInterface $weatherRepository)
	{
		$this->weatherRepository = $weatherRepository;
	}

	/**
	 * @return WeatherAtDateDto[]
	 */
	public function getByLastMonth(): array
	{
		$dateFrom = DateHelper::current()->modify("-1 month")->format("Y-m-d");
		$data = $this->weatherRepository->getFrom($dateFrom);

		$result = [];
		foreach ($data as $item) {
			$obj = new WeatherAtDateDto();
			$obj->date = $item[WeatherAtDateDto::ATTR_DATE];
			$obj->temp = $item[WeatherAtDateDto::ATTR_TEMP];

			$result[] = $obj;
		}

		return $result;
	}

	/**
	 * @param DateTimeImmutable $date
	 * @return WeatherAtDateDto
	 */
	public function getByDate(DateTimeImmutable $date): WeatherAtDateDto
	{
		$data = $this->weatherRepository->getFrom($date->format("Y-m-d"), true);
		$obj = new WeatherAtDateDto();
		$obj->date = $data[WeatherAtDateDto::ATTR_DATE];
		$obj->temp = $data[WeatherAtDateDto::ATTR_TEMP];

		return $obj;
	}

}
