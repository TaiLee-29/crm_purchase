<?php

namespace app\controllers;

use app\adapters\FilesystemAdapter;
use app\models\Request;
use app\models\RequestFile;
use app\models\RequestSearch;
use League\Flysystem\FilesystemException;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

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
        return
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],

            ];
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
    public function actionView(int $id)
    {
        $model=$this->findModel($id);
        $images = $model->files;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'images' => $images,

        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws FilesystemException
     * @throws Exception
     */
    public function actionCreate()
    {  /*if (!\Yii::$app->user->can('createRequest')) {
        throw new ForbiddenHttpException('Access denied');
    }*/
        $model = new Request();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $model->status = Request::STATUS_NEW;
                $filesystem = FilesystemAdapter::adapter();
                $files = UploadedFile::getInstances($model, 'imageFiles');
                foreach ($files as $file) {
                    $path = Yii::$app->getSecurity()->generateRandomString(15) . "." . $file->extension;
                    $fileStream = fopen($file->tempName, 'r+');
                    $filesystem->writeStream('local/' . $path, $fileStream, ['mimeType' => $file->type]);
                    $file = new RequestFile();
                    $file->request_id = $model->id;
                    $file->path_to_file = '@web/uploads/local/' . $path;
                    $file->save();
                }
                $model->save();
                if (Yii::$app->user->can('changeRequestStatus')) {
                    $model->status = $this->request->post()['Request']['status'];
                    $model->save();
                }
            }
             //var_dump($model->imageFiles);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->loadDefaultValues();
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
    public function actionUpdate(int $id)
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
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {$model = $this->findModel($id);
        if (Yii::$app->user->can('deleteRequest')) {
            if (Yii::$app->user->getId() == $model->created_by) {
                $model->delete();
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
