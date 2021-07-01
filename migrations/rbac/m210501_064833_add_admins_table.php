<?php

use app\models\User;
use yii\db\Migration;
use yii\db\Expression;

class m210501_064833_add_admins_table extends Migration
{
    /**
     * @var mixed
     */


    public function up()
    {

        $this->insert('{{%user}}', [
            'id'            => 100,
            'username'      => 'admin',
            'email'         => 'admin@gmail.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin123'),
            'auth_key'      => Yii::$app->getSecurity()->generateRandomString(),
            'status'     => User::STATUS_ACTIVE,
            'created_at'    => new Expression('NOW()'),
            'updated_at'    => new Expression('NOW()'),
        ]);





    }


    public function down()
    {
        $this->delete('{{%user}}', [
            'id' => [100],
        ]);
    }
}