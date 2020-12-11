<?php

declare(strict_types=1);

namespace app\repositories\weather\request;

/**
 * Interface WeatherRequestParametersInterface
 */
interface WeatherRequestParametersInterface
{
	/**
	 * @return array
	 */
	public function getData(): array;

	/**
	 * @return string
	 */
	public function getMethod(): string;
}