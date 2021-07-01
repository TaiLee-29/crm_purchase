<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchase}}`.
 */
class m210607_144756_create_purchase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%purchase}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->float()->notNull(),
            'request_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-purchase-request_id',
            '{{%purchase}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-purchase-request_id',
            '{{%purchase}}'
        );
        $this->dropTable('{{%purchase}}');
    }
}
