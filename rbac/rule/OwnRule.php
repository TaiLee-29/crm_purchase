<?php

declare(strict_types=1);
namespace app\rbac\rule;


use app\models\Request;
use Yii;
use yii\rbac\Item;
use yii\rbac\Rule;

class OwnRule extends Rule
{
    public $name ='OwnRule';
    /**
     * @var mixed
     */
        public function execute($user, $item, $params)
    {

            return isset($params['model']) ? $params['model']->created_by == $user : false;


    }
}