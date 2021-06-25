<?php


namespace app\widgets\upload;

use rmrevin\yii\fontawesome\AssetBundle;

class UploadAsset extends \trntv\filekit\widget\UploadAsset
{
    public $sourcePath = __DIR__ . '/assets';
    public $depends = [
        \yii\web\JqueryAsset::class,
        \trntv\filekit\widget\BlueimpFileuploadAsset::class,
        AssetBundle::class
    ];
    public $js = [
        YII_DEBUG ? 'js/upload-kit.js' : 'js/upload-kit.min.js',
    ];
}
