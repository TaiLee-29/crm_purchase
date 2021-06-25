<?php


namespace app\widgets\upload;

use yii\helpers\Json;
use yii\jui\JuiAsset;

class Upload extends \trntv\filekit\widget\Upload
{
    public $url = ['/file/upload'];

    public function registerClientScript()
    {
        UploadAsset::register($this->getView());
        $options = Json::encode($this->clientOptions);
        if ($this->sortable) {
            JuiAsset::register($this->getView());
        }

        $this->getView()->registerJs("jQuery('#{$this->getId()}').yiiUploadKit({$options});");
    }
}
