<?php

use app\rbac\Migration;
use app\rbac\Rbac;

class m210629_120501_add_permissions_table extends Migration
{
    /**
     * @var mixed
     */
    public function up()
    {

        $user = $this->auth->getRole(Rbac::ROLE_USER);
        $admin = $this->auth->getRole(Rbac::ROLE_ADMIN);



        $rule = new \app\rbac\rule\OwnRuleRequest();
        $this->auth->add($rule);
        $rule2 = new \app\rbac\rule\OwnRuleFile();
        $this->auth->add($rule2);
        $createRequest = $this->auth->createPermission('createRequest');
        $createRequest->description = 'Create a Request';
        $this->auth->add($createRequest);

        $deleteRequest = $this->auth->createPermission('deleteRequest');
        $deleteRequest->description = 'Delete Request';
        $deleteRequest->ruleName = $rule->name;
        $this->auth->add($deleteRequest);

        $updateRequest = $this->auth->createPermission('updateRequest');
        $updateRequest->description = 'Update Request';
        $updateRequest->ruleName = $rule->name;
        $this->auth->add($updateRequest);

        $uploadFile = $this->auth->createPermission('uploadFile');
        $uploadFile->description = 'Upload File';
        $this->auth->add($uploadFile);

        $deleteFile = $this->auth->createPermission('deleteFile');
        $deleteFile->description = 'Delete File';
        $updateRequest->ruleName = $rule2->name;
        $this->auth->add($deleteFile);

        $this->auth->addChild($user, $createRequest);
        $this->auth->addChild($user, $updateRequest);
        $this->auth->addChild($user, $deleteRequest);
        $this->auth->addChild($user, $uploadFile);
        $this->auth->addChild($user, $deleteFile);

        $changeRequestStatus = $this->auth->createPermission('changeRequestStatus');
        $changeRequestStatus->description = 'Change Request Status';
        $this->auth->add($changeRequestStatus);

        $createPurchase = $this->auth->createPermission('createPurchase');
        $createPurchase->description = 'Create a Purchase';
        $this->auth->add($createPurchase);

        $deletePurchase = $this->auth->createPermission('deletePurchase');
        $deletePurchase->description = 'Delete Purchase';
        $deletePurchase->ruleName = $rule->name;
        $this->auth->add($deletePurchase);

        $updatePurchase = $this->auth->createPermission('updatePurchase');
        $updatePurchase->description = 'Update Request';
        $updatePurchase->ruleName = $rule->name;
        $this->auth->add($updatePurchase);

        $this->auth->addChild($admin, $createRequest);
        $this->auth->addChild($admin, $updateRequest);
        $this->auth->addChild($admin, $changeRequestStatus);
        $this->auth->addChild($admin, $createPurchase);
        $this->auth->addChild($admin, $updatePurchase);
        $this->auth->addChild($admin, $deletePurchase);
        $this->auth->addChild($admin, $uploadFile);
        $this->auth->addChild($admin, $deleteFile);

    }

    public function down()
    {
        $this->auth->remove($this->auth->getPermission('updatePurchase'));
        $this->auth->remove($this->auth->getPermission('deletePurchase'));
        $this->auth->remove($this->auth->getPermission('createPurchase'));
        $this->auth->remove($this->auth->getPermission('changeRequestStatus'));
        $this->auth->remove($this->auth->getPermission('deleteFile'));
        $this->auth->remove($this->auth->getPermission('uploadFile'));
        $this->auth->remove($this->auth->getPermission('updateRequest'));
        $this->auth->remove($this->auth->getPermission('deleteRequest'));
        $this->auth->remove($this->auth->getPermission('createRequest'));

        $this->auth->remove($this->auth->getRule('OwnRuleFile'));
        $this->auth->remove($this->auth->getRule('OwnRuleRequest'));
    }


}