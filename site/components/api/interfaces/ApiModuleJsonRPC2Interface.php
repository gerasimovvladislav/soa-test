<?php

declare(strict_types=1);

namespace app\components\api\interfaces;

/**
 * Интерфейс модуля для работы с АПИ спецификации json-rpc v2.0.
 */
interface ApiModuleJsonRPC2Interface
{
	/**
	 * Устанавливает имя вызываемого метода.
	 * @param string $methodName
	 */
	public function setMethod(string $methodName): void;
}