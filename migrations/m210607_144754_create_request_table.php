<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m210607_144754_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'description' => $this->string()->notNull(),
            'created_by' => $this->integer(),
            'status' => 'ENUM("new", "pending", "accepted", "declined") NOT NULL DEFAULT "new"',
            'image_files' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->addForeignKey(
            'fk-request-created_by',
            '{{%request}}',
            'created_by',
            '{{%user}}',
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
            'fk-request-created_by',
            '{{%request}}'
        );
        $this->dropTable('{{%request}}');
    }


}
