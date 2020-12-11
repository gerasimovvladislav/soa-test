<?php

declare(strict_types=1);

namespace app\components\api\interfaces;

interface ApiModuleAbstractFactoryInterface
{
	public static function createForJsonRpc2(): ApiModuleInterface;
}