<?php

declare(strict_types=1);

namespace app\validators;

use yii\validators\FilterValidator;

/**
 * {@inheritDoc}
 */
class FloatValValidator extends FilterValidator {
	/**
	 * {@inheritDoc}
	 */
	public function __construct($config = []) {
		$this->filter      = 'floatval';
		$this->skipOnEmpty = true;

		parent::__construct($config);
	}
}
