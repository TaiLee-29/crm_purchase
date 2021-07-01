<?php

use app\models\User;
use app\rbac\Migration;
use yii\base\BaseObject;


class m210629_120314_add_roles_table extends Migration
{

    public function up()
    {
        $this->auth->removeAll();

        $user = $this->auth->createRole('user');
        $user->description = 'Role user';
        $this->auth->add($user);

        $admin = $this->auth->createRole('admin');
        $admin->description = 'Role admin';
        $this->auth->add($admin);

        $this->auth->assign($admin,User::ADMIN_ID);

    }

    public function down()
    {
        $this->auth->remove($this->auth->getRole('user'));
        $this->auth->remove($this->auth->getRole('admin'));
    }
}