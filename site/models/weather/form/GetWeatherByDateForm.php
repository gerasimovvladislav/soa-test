<?php

declare(strict_types=1);

namespace app\models\weather\form;

use Yii;
use yii\base\Model;
use yii\validators\DateValidator;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

/**
 * Форма получения погоды по дате.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class GetWeatherByDateForm extends Model
{
	const ATTR_DATE = 'date';

	/** @var string Дата на которую получаем погоду. */
	public $date;

	/**
	 * @return array|array[]
	 */
	public function rules()
	{
		return [
			[static::ATTR_DATE, RequiredValidator::class],
			[static::ATTR_DATE, StringValidator::class],
		];
	}

	/**
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			static::ATTR_DATE => Yii::t('app', 'Дата'),
		];
	}
}