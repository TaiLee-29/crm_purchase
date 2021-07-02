<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'description',
            'created_by',
            'status',
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>Yii::t('app','Actions'),
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($urlUpdate,$model)  {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot">Update</span>',
                            $urlUpdate);
                    },
                    'delete' => function ($urlDelete,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot">Delete</span>',
                            $urlDelete);
                    },
                    'view' => function ($urlView,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot">View</span>',
                            $urlView);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
