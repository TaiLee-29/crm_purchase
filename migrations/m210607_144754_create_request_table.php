<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m210607_144754_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'created_by' => $this->integer(),
            'created_at' => $this->dateTime(),
        ]);
        $this->addForeignKey(
            'fk-request-created_by',
            '{{%request}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }


    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable('{{%request}}');
    }
}
