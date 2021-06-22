<?php


namespace app\models;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $description
 * @property int|null $created_by
 * @property string $status
 * @property string $imageFiles
 * @property Json $images_path
 * @property string|null $created_at
 *
 * @property User $createdBy
 * @property Purchase[] $purchases
 */
class Request extends \yii\db\ActiveRecord
{
    public $imageFiles;
    const STATUS_NEW = 'new';
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';
    /**
     * @var bool|mixed|null
     */


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
            ],
            'file' =>[
                'class' => UploadBehavior::class,
                'attribute'=> 'file',
                'pathAttribute' => '',
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
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
            [['images_path'], 'string'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'Name'),
            'description' => 'Description',
            'created_by' => 'Created By',
            'status' => 'Status',
            'images_path' => 'Images Path',
            'created_at' => 'Created At',
            'imageFiles' => 'Image Files'
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['request_id' => 'id']);
    }

}