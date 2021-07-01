<?php

declare(strict_types=1);
namespace app\rbac\rule;


use yii\rbac\Rule;

class OwnRuleRequest extends Rule
{
    public $name ='OwnRuleRequest';
    /**
     * @var mixed
     */
        public function execute($user, $item, $params)
    {

            return isset($params['model']) && $params['model']->created_by == $user;
    }
}