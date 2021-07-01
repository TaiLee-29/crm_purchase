<?php


namespace app\adapters;


use League\Flysystem\Filesystem;
use Yii;
use yii\base\BaseObject;

class FileSystemBuilder extends BaseObject implements \trntv\filekit\filesystem\FilesystemBuilderInterface
{
    /**
     * @var
     */
    public $path;

    /**
     * @return Filesystem
     */
    public function build(): \League\Flysystem\Filesystem
    {
        $adapter = new \League\Flysystem\Adapter\Local(Yii::getAlias($this->path));
        return new  \League\Flysystem\Filesystem($adapter);
    }
}