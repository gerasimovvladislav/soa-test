<?php

declare(strict_types=1);

namespace app\models;

use app\validators\FloatValValidator;
use Yii;
use yii\db\ActiveRecord;
use yii\validators\DateValidator;
use yii\validators\RequiredValidator;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property float $temp
 * @property string $date_at
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class RefHistory extends ActiveRecord
{
	const ATTR_ID = 'id';
	const ATTR_TEMP = 'temp';
	const ATTR_DATE_AT = 'date_at';

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'history';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[static::ATTR_TEMP, RequiredValidator::class],
			[static::ATTR_TEMP, FloatValValidator::class],
			[static::ATTR_DATE_AT, RequiredValidator::class],
			[static::ATTR_DATE_AT, DateValidator::class],
		];
	}
}
