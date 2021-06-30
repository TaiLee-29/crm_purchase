<?php


namespace app\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class FileController extends Controller
{
    public function behaviors()
    {
        return
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['upload'],
                            'roles' => ['uploadFile'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['deleteFile'],
                        ],
                    ],
                ],

            ];
    }
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