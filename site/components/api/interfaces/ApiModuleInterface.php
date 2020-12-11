<?php

declare(strict_types=1);

namespace app\components\api\interfaces;

/**
 * Интерфейс модуля для работы с АПИ.
 */
interface ApiModuleInterface
{
	/**
	 * Устанавливает URL для отправки запроса.
	 * @param string $url
	 */
	public function setUrl(string $url): void;

	/**
	 * Устанавливает параметры для запроса.
	 * @param array $params
	 */
	public function setParams(array $params): void;

	/**
	 * Отправляет запрос
	 * @return mixed
	 */
	public function send();
}