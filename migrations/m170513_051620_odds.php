<?php

use yii\db\Migration;

class m170513_051620_odds extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%odds}}', [
            'id' => $this->primaryKey(),
            'odds_uk' => $this->string(),
            'odds_eu' => $this->float(2),
            'odds_usa' => $this->integer(),
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%odds}}');
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
