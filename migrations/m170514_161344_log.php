<?php

use yii\db\Migration;

class m170514_161344_log extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'odds_uk' => $this->string(),
            'odds_eu' => $this->float(2),
            'odds_usa' => $this->float(2),
            'ip' => $this->string(),
            'hostname' => $this->string(),
            'org' => $this->string(),
            'loc' => $this->string(),
            'city' => $this->string(),
            'region' => $this->string(),
            'country' => $this->string(),
            'created_at' => $this->integer()
        ], $tableOptions);
    }
    public function down()
    {
        $this->dropTable('{{%log}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170514_161344_log cannot be reverted.\n";

        return false;
    }
    */
}
