<?php

declare(strict_types=1);

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * AR для таблицы пользователей.
 * TODO: Yii2 (интерфейс IdentityInterface) обязывает нас нарушать SRP, поэтому реализации методов отсутствуют, но они якобы есть.
 *
 * @author Vladislav Gerasimov <gerasim9393@mail.ru>
 */
class RefUser extends ActiveRecord implements IdentityInterface
{
	/** {@inheritDoc} */
	public static function findIdentity($id)
	{
		return null;
	}

	/** {@inheritDoc} */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return null;
	}

	/** {@inheritDoc} */
	public function getId()
	{
		return;
	}

	/** {@inheritDoc} */
	public function getAuthKey()
	{
		return;
	}

	/** {@inheritDoc} */
	public function validateAuthKey($authKey)
	{
		return;
	}
}
