<?php

use app\models\RefHistory;
use yii\db\Migration;

/**
 * Class m201211_113500_create_table_history
 */
class m201211_113500_create_table_history extends Migration
{
	/**
	 * @return bool|void|null
	 */
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}


		$this->createTable(RefHistory::tableName(), [
			RefHistory::ATTR_ID => $this->primaryKey(),
			RefHistory::ATTR_TEMP => $this->float()->notNull(),
			RefHistory::ATTR_DATE_AT => $this->date()->notNull(),
		], $tableOptions);
	}

	/**
	 * @return bool|void|null
	 */
	public function down()
	{
		$this->dropTable(RefHistory::tableName());
	}
}
