<?php


namespace app\adapters;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;


class FilesystemAdapter extends \League\Flysystem\Local\LocalFilesystemAdapter implements \League\Flysystem\FilesystemAdapter
{

    public static function adapter()
    {
        $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter(  \dirname(__DIR__) .'/web/uploads');
        $filesystem = new \League\Flysystem\Filesystem($adapter);
        return $filesystem;
    }
}


