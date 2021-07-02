<?php

declare(strict_types=1);
namespace app\rbac\rule;



use yii\rbac\Rule;

class OwnRuleFile extends Rule
{
    public $name ='OwnRuleFile';
    /**
     * @var mixed
     */
        public function execute($user, $item, $params)
    {
            return isset($params['model']) && $params['model']->request_id == \Yii::$app->user;
    }
}