<?php

use app\helpers\DateHelper;
use app\models\RefHistory;
use yii\db\Migration;

/**
 * Class m201211_114706_add_fake_data
 */
class m201211_114706_add_fake_data extends Migration
{
	/**
	 * @return bool|void|null
	 */
	public function up()
	{
		$startDate = DateHelper::current()->modify("-6 month");
		$endDate = DateHelper::current()->modify("+1 day");

		$rows = [];
		$tsFakeDay = $startDate->getTimestamp();
		$tsEndDay = $endDate->getTimestamp();
		while ($tsFakeDay < $tsEndDay) {
			$rows[] = [
				RefHistory::ATTR_TEMP => rand((20*-1), 20),
				RefHistory::ATTR_DATE_AT => date("Y-m-d", $tsFakeDay),
			];
			$tsFakeDay += 86400;
		}

		Yii::$app->db->createCommand()->batchInsert(RefHistory::tableName(), [RefHistory::ATTR_TEMP, RefHistory::ATTR_DATE_AT], $rows)->execute();
	}

	/**
	 * @return bool|void|null
	 */
	public function down()
	{
		RefHistory::deleteAll();
	}
}
