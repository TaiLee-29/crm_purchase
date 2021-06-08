<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
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

        // добавляем разрешение "updatePost"
        $updateRequest = $auth->createPermission('updateRequest');
        $updateRequest->description = 'Update Request';
        $auth->add($updateRequest);

        $changeRequestStatus = $auth->createPermission('changeRequestStatus');
        $changeRequestStatus->description = 'Change Request Status';
        $auth->add($changeRequestStatus);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createRequest);
        $auth->addChild($author, $updateRequest);
        $auth->addChild($author, $deleteRequest);


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
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $changeRequestStatus);
        $auth->addChild($admin, $createPurchase);
        $auth->addChild($admin, $updatePurchase);
        $auth->addChild($admin, $deletePurchase);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }
}
