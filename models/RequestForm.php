<?php


namespace app\models;


use Yii;
use yii\base\BaseObject;
use yii\base\Model;


class RequestForm extends Model
{
    /**
     * @var mixed
     */
   public $description;
    /**
     * @var mixed
     */
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['created_by'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    public function create()
    {
        if ($this->validate()) {
            $request = new Request();
            $request->description = $this->description;
            $request->status = \app\models\Request::STATUS_NEW;
            if (Yii::$app->user->can('changeRequestStatus')) {
                $request->status = $this->request->post()['Request']['status'];
            }
            $request->save();
            return true;
        }
        return false;
    }

}