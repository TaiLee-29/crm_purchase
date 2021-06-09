<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property int $id
 * @property string $description
 * @property string $name
 * @property float $price
 * @property int|null $request_id
 * @property string|null $status
 *
 * @property Request $request
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%purchase}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'name', 'price'], 'required'],
            [['price'], 'number'],
            [['request_id'], 'integer'],
            [['description', 'name', 'status'], 'string', 'max' => 255],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'name' => 'Name',
            'price' => 'Price',
            'request_id' => 'Request ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
}