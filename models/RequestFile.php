<?php

namespace app\models;

use Yii;

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
}
