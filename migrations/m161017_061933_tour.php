<?php

use yii\db\Schema;
use yii\db\Migration;

class m161017_061933_tour extends Migration
{
    public function up()
    {
		$tableOptions = null;
          if ($this->db->driverName === 'mysql') {
              $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
          }
 
          $this->createTable('{{%tour}}', [
              'id' => Schema::TYPE_PK,
              'name' => Schema::TYPE_TEXT.' NOT NULL',
              'adult_q' => Schema::TYPE_INTEGER . ' DEFAULT 0',
              'child_q' => Schema::TYPE_INTEGER . ' DEFAULT 0',
              'baby_q' => Schema::TYPE_INTEGER . ' DEFAULT 0',
          ], $tableOptions);
		
		$this->createTable('{{%uq_fields}}', [
              'id' => Schema::TYPE_PK,
              'id_tour' => Schema::TYPE_INTEGER.' NOT NULL',
              'field_name' => Schema::TYPE_TEXT . ' NOT NULL',
              'field_data' => Schema::TYPE_TEXT . ' NOT NULL',
          ], $tableOptions);
		
		$this->createTable('{{%booking}}', [
              'id' => Schema::TYPE_PK,
              'id_user' => Schema::TYPE_INTEGER.' NOT NULL',
              'id_tour' => Schema::TYPE_INTEGER.' NOT NULL',
              'date_tour' => Schema::TYPE_DATE . ' NOT NULL',
          ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%tour}}');
		$this->dropTable('{{%uq_fields}}');
		$this->dropTable('{{%booking}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
