<?php

namespace app\commands;

use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
        // добавляем разрешение "createPost"
        $createRequest = $auth->createPermission('createRequest');
        $createRequest->description = 'Create a Request';
        $auth->add($createRequest);

        $deleteRequest = $auth->createPermission('deleteRequest');
        $deleteRequest->description = 'Delete Request';
        $auth->add($deleteRequest);

        // добавляем разрешение "updatePost "
        $updateRequest = $auth->createPermission('updateRequest');
        $updateRequest->description = 'Update Request';
        $auth->add($updateRequest);

        $changeRequestStatus = $auth->createPermission('changeRequestStatus');
        $changeRequestStatus->description = 'Change Request Status';
        $auth->add($changeRequestStatus);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createRequest);
        $auth->addChild($user, $updateRequest);
        $auth->addChild($user, $deleteRequest);


        $createPurchase = $auth->createPermission('createPurchase');
        $createPurchase->description = 'Create a Purchase';
        $auth->add($createPurchase);

        $deletePurchase = $auth->createPermission('deletePurchase');
        $deletePurchase->description = 'Delete Purchase';
        $auth->add($deletePurchase);

        // добавляем разрешение "updatePost"
        $updatePurchase = $auth->createPermission('updatePurchase');
        $updatePurchase->description = 'Update Request';
        $auth->add($updatePurchase);
        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createRequest);
        $auth->addChild($admin, $updateRequest);
        $auth->addChild($admin, $changeRequestStatus);
        $auth->addChild($admin, $createPurchase);
        $auth->addChild($admin, $updatePurchase);
        $auth->addChild($admin, $deletePurchase);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $model = new User();
        $model->username = 'admin';
        $model->email = 'admin@gmail.com';
        $model->setPassword('admin123');
        $model->generateAuthKey();
        $model->save();
        $auth->assign($admin, $model->getId());
    }
}
