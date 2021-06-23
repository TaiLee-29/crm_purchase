<?php

use yii\db\Migration;

/**
 * Class m210623_063717_request_files
 */
class m210623_063717_request_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_file}}', [
            'id' => $this->primaryKey(),
            'path_to_file' => $this->string(),
            'request_id' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-file-request_id',
            '{{%request_file}}',
            'request_id',
            '{{%request}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-file-request_id',
            '{{%request_file}}'
        );
        $this->dropTable('{{%request_file}}');
    }


}
