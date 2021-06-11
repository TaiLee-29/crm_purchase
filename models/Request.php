<?php



namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $description
 * @property int|null $created_by
 * @property string $status
 * @property string|null $created_at
 *
 * @property User $createdBy
 * @property Purchase[] $purchases
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED= 'accepted';
    const STATUS_DECLINED = 'declined';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['created_by'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_by' => 'Created By',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['request_id' => 'id']);
    }

}