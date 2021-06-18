<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, Yii::t('app', 'id')) ?>

    <?= $form->field($model, Yii::t('app', 'description')) ?>

    <?= $form->field($model, Yii::t('app', 'created_by')) ?>

    <?= $form->field($model, Yii::t('app', 'status')) ?>

    <?= $form->field($model, Yii::t('app', 'created_at')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
