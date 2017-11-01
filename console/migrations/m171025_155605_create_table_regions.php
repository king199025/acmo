<?php

use yii\db\Migration;

class m171025_155605_create_table_regions extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171025_155605_create_table_regions cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'url' => $this->string(255),
            'coordLatitude' => $this->string(100),
            'coordLongitude' => $this->string(100),
        ]);
    }

    public function down()
    {
        $this->dropTable('region');
    }

}
