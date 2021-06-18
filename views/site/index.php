<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">homepage</h1>

        <p class="lead">RexIT CRM system</p>

        <p><a class="btn btn-lg btn-success" href="http://localhost:8000/site/login">Pls login</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Heading')?></h2>

                <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.')?></p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/"><?=Yii::t('app', 'Yii Documentation')?>
                        &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Heading')?></h2>

                <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.')?></p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/"><?=Yii::t('app', 'Yii Forum')?> &raquo;</a>
                </p>
            </div>
            <div class="col-lg-4">
                <h2><?=Yii::t('app', 'Heading')?></h2>

                <p><?=Yii::t('app', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                    dolore eu
                    fugiat nulla pariatur.')?></p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/"><?=Yii::t('app', 'Yii Extensions')?>
                        &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
