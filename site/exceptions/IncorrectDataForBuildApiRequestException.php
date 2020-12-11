<?php

declare(strict_types=1);

namespace app\exceptions;

use Exception;


/**
 * Класс исключения говорит о том что данных для составления запроса в API недостаточно или они некорректные
 */
class IncorrectDataForBuildApiRequestException extends Exception
{
	//...
}