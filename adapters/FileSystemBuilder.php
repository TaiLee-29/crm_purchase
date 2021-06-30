<?php


namespace app\adapters;


class FileSystemBuilder implements \trntv\filekit\filesystem\FilesystemBuilderInterface
{
    public function build(): \League\Flysystem\Filesystem
    {
        $adapter =  new \League\Flysystem\Adapter\Local('uploads');
        return new  \League\Flysystem\Filesystem($adapter);
    }
}