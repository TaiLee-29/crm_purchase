<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            <?=Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.')?>
        </div>

        <p>
            <?=Yii::t('app', 'Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.')?>
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                <?=Yii::t('app', 'Because the application is in development mode, the email is not sent but saved as
                a file under ')?><code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                <?=Yii::t('app', 'Please configure the')?>
                <code><?=Yii::t('app', 'useFileTransport')?></code><?=Yii::t('app', 'property of the')?>  <code><?=Yii::t('app', 'mail')?></code>
                <?=Yii::t('app', 'application component to be false to enable email sending.')?>
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            <?=Yii::t('app', 'If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.')?>
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, Yii::t('app', 'name'))->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, Yii::t('app', 'email')) ?>

                <?= $form->field($model, Yii::t('app', 'subject')) ?>

                <?= $form->field($model, Yii::t('app', 'body'))->textarea(['rows' => 6]) ?>

                <?= $form->field($model, Yii::t('app', 'verifyCode'))->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
