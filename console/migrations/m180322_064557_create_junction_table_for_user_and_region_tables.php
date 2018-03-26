<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_region`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `region`
 */
class m180322_064557_create_junction_table_for_user_and_region_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_region', [
            'user_id' => $this->integer(),
            'region_id' => $this->integer(),
            'PRIMARY KEY(user_id, region_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_region-user_id',
            'user_region',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_region-user_id',
            'user_region',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `region_id`
        $this->createIndex(
            'idx-user_region-region_id',
            'user_region',
            'region_id'
        );

        // add foreign key for table `region`
        $this->addForeignKey(
            'fk-user_region-region_id',
            'user_region',
            'region_id',
            'region',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_region-user_id',
            'user_region'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_region-user_id',
            'user_region'
        );

        // drops foreign key for table `region`
        $this->dropForeignKey(
            'fk-user_region-region_id',
            'user_region'
        );

        // drops index for column `region_id`
        $this->dropIndex(
            'idx-user_region-region_id',
            'user_region'
        );

        $this->dropTable('user_region');
    }
}
