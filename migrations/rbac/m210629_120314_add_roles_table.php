<?php

use app\models\User;
use app\rbac\Migration;
use yii\base\BaseObject;

class m210629_120314_add_roles_table extends Migration
{

    public function Up()
    {

        $this->auth->removeAll();

        $user = $this->auth->createRole('user');
        $user->description = 'Role user';
        $this->auth->add($user);

        $admin = $this->auth->createRole('admin');
        $admin->description = 'Role admin';
        $this->auth->add($admin);

        $model = new User();
        $model->username = 'admin';
        $model->email = 'admin@gmail.com';
        $model->setPassword('admin123');
        $model->generateAuthKey();
        $model->save();
        $this->auth->assign($admin, $model->getId());

        $model = new User();
        $model->username = 'admin22';
        $model->email = 'admin22@gmail.com';
        $model->setPassword('admin123');
        $model->generateAuthKey();
        $model->save();
        $this->auth->assign($admin, $model->getId());

    }

    public function Down()
    {
        $this->auth->remove($this->auth->getRole('user'));
        $this->auth->remove($this->auth->getRole('admin'));
    }
}