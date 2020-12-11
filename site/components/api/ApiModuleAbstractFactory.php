<?php

declare(strict_types=1);

namespace app\components\api;

use app\components\api\interfaces\ApiModuleAbstractFactoryInterface;
use app\components\api\interfaces\ApiModuleInterface;

/**
 * Фабрика различных модулей для работы API.
 */
class ApiModuleAbstractFactory implements ApiModuleAbstractFactoryInterface
{
	/**
	 * @return ApiModuleInterface
	 */
	public static function createForJsonRpc2(): ApiModuleInterface
	{
		return new ApiModuleJsonRPC2();
	}
}