<?php


namespace app\models;

use app\widgets\upload\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;

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
 * @property RequestFile[] $requestFiles
 * @property string $updated_at [datetime]
 */
class Request extends ActiveRecord
{
    public $files;
    public const STATUS_NEW = 'new';

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

    public function behaviors(): array
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
            [
                'class' => UploadBehavior::class,
                'attribute'      => 'files',
                'multiple'       => true,
                'uploadRelation'=> 'requestFiles',
                'pathAttribute' => 'path_to_file',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description','status'], 'required'],
            [['created_by'], 'integer'],
            [['status'],'string'],
//            ['status', 'default', 'value' => Request::STATUS_NEW],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['files'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' =>  Yii::t('app', 'Description'),
            'created_by' =>  Yii::t('app', 'Created By'),
            'status' => Yii::t('app',  'Status'),
            'created_at' =>  Yii::t('app', 'Created At'),
            'imageFiles' =>  Yii::t('app', 'Image Files')
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return ActiveQuery
     */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return ActiveQuery
     */
    public function getPurchases(): ActiveQuery
    {
        return $this->hasMany(Purchase::class, ['request_id' => 'id']);
    }

    public function getRequestFiles(): ActiveQuery
    {
        return $this->hasMany(RequestFile::class, ['request_id' => 'id']);
    }

}