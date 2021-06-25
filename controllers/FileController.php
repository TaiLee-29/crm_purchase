<?php


namespace app\controllers;


use yii\web\Controller;

class FileController extends Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                'deleteRoute' => 'delete',
            ],
            'delete' => [
                'class' => 'trntv\filekit\actions\DeleteAction',
            ],
            'view' => [
                'class' => 'trntv\filekit\actions\ViewAction',
            ],
        ];
    }

}