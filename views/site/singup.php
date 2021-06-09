<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="singup">

    <?php $form = ActiveForm::begin(['id' => 'form-sing-up']); ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'rawPassword')->passwordInput() ?>

        <?= $form->field($model, 'email') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app/views/user', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- singup -->
