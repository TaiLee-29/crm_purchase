<?php


namespace app\widgets\upload;


use yii\helpers\VarDumper;

class UploadBehavior extends \trntv\filekit\behaviors\UploadBehavior
{
    protected function enrichFileData($file)
    {
        $file = parent::enrichFileData($file);
        if (\array_key_exists('path', $file)) {
            $file['url'] = $this->storage->baseUrl.DIRECTORY_SEPARATOR.$file['path'];
        }

        return $file;
    }
}
