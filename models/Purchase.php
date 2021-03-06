<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
            [['description', 'name'], 'string', 'max' => 255],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' =>  Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'request_id' => Yii::t('app', 'Request ID')
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