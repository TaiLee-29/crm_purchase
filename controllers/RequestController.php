<?php

namespace app\controllers;

use app\models\adapters\FilesystemAdapter;
use app\models\Request;
use app\models\RequestSearch;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                [
                    'class' => TimestampBehavior::className(),
                    'createdAtAttribute' => 'created_at',
                    'updatedAtAttribute' => false,
                    'value' => new Expression('NOW()'),
                ],

            ]
        );
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \League\Flysystem\FilesystemException
     */
    public function actionCreate()
    {  /*if (!\Yii::$app->user->can('createRequest')) {
        throw new ForbiddenHttpException('Access denied');
    }*/
        $model = new Request();
        if ($this->request->isPost) {
            if (($answerItemsData = Yii::$app->getRequest()->getBodyParam('Request')) !== null) {
                if ($model->load($answerItemsData) && $model->save(false)) {
                    $filesystem = FilesystemAdapter::adapter();
                    $files = UploadedFile::getInstances($model, 'imageFiles');
                    foreach ($files as $file) {
                        $path = Yii::$app->getSecurity()->generateRandomString(15) . "." . $file->extension;
                        $fileStream = fopen($file->tempName, 'r+');
                        $filesystem->writeStream('local/' . $path, $fileStream, ['mimeType' => $file->type]);
                        $model->imageFiles = 'app/web/local/' . $path;
                        $model->status = Request::STATUS_NEW;
                        if (Yii::$app->user->can('changeRequestStatus')) {
                            $model->status = $this->request->post()['Request']['status'];
                        }
                        $model->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);

            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if ($this->request->isPost) {
            if (Yii::$app->user->can('admin')) {
                if ($model->load($this->request->post()) && $model->save()) {
                    if (Yii::$app->user->can('changeRequestStatus')) {
                        $model->status = $this->request->post()['Request']['status'];
                        $model->save();
                    }
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            if (Yii::$app->user->getId() == $model->created_by) {
                if ($model->load($this->request->post()) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);


    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteRequest')) {
            $model = $this->findModel($id);
            if (Yii::$app->user->getId() == $model->created_by) {
                $model->delete();
                return $this->redirect(['index']);
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
