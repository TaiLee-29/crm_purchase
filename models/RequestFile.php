<?php

namespace app\models;

use Yii;
use yii\web\Response;

/**
 * This is the model class for table "request_file".
 *
 * @property int $id
 * @property string|null $path_to_file
 * @property int|null $request_id
 *
 * @property Request $request
 */
class RequestFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%request_file}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['request_id'], 'integer'],
            [['path_to_file'], 'string', 'max' => 255],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'path_to_file' => Yii::t('app', 'Path To File'),
            'request_id' => Yii::t('app', 'Request ID'),
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }

    public function actionUpload()
    {
        return [
            'upload' => [
                'class' => 'trntv\filekit\actions\UploadAction',
                //'deleteRoute' => 'my-custom-delete', // my custom delete action for deleting just uploaded files(not yet saved)
                //'fileStorage' => 'myfileStorage', // my custom fileStorage from configuration
                'multiple' => true,
                'disableCsrf' => true,
                'responseFormat' => Response::FORMAT_JSON,
                'responsePathParam' => 'path',
                'responseBaseUrlParam' => 'base_url',
                'responseUrlParam' => 'url',
                'responseDeleteUrlParam' => 'delete_url',
                'responseMimeTypeParam' => 'type',
                'responseNameParam' => 'name',
                'responseSizeParam' => 'size',
                'deleteRoute' => 'delete',
                'fileStorage' => 'fileStorage', // Yii::$app->get('fileStorage')
                'fileStorageParam' => 'fileStorage', // ?fileStorage=someStorageComponent
                'sessionKey' => '_uploadedFiles',
                'allowChangeFilestorage' => false,
                'on afterSave' => function ($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;
                    // do something (resize, add watermark etc)
                }
            ]
        ];
    }

    public function actionDelete()
    {
        return [
            'delete' => [
                'class' => 'trntv\filekit\actions\DeleteAction',
                //'fileStorage' => 'fileStorageMy', // my custom fileStorage from configuration(such as in the upload action)
            ]
        ];
    }

    public function actionView()
    {
        return [
            'view' => [
                'class' => 'trntv\filekit\actions\ViewAction',
            ]
        ];
    }
}
