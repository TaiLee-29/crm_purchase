<?php

use yii\db\Migration;

/**
 * Class m210615_110005_request_files_table
 */
class m210615_110005_request_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $this->createTable('{{%request_files}}', [
            'id' => $this->primaryKey(),
            'belong_to' => $this->integer(),
            'path' => $this->string()
        ]);
        $this->addForeignKey(
            'fk-request-belong_to',
            '{{%request_files}}',
            'belong_to',
            '{{%request}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropForeignKey(
            'fk-request-belong_to',
            '{{%request_files}}'
        );
        $this->dropTable('{{%request_files}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210615_110005_request_files_table cannot be reverted.\n";

        return false;
    }
    */
}
