<?php

use yii\db\Migration;

/**
 * Class m210606_110113_create_user_tbl
 */
class m210606_110113_create_user_tbl extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function Up(){
    $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
        ]);
    }
public function down()
{
    $this->dropTable('{{%user}}');
}

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210606_110113_create_user_tbl cannot be reverted.\n";

        return false;
    }
    */
}
