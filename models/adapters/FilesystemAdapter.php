<?php


namespace app\models\adapters;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;


class FilesystemAdapter extends \League\Flysystem\Local\LocalFilesystemAdapter implements \League\Flysystem\FilesystemAdapter
{

    public static function adapter()
    {
        //$adapter = new LocalFilesystemAdapter(\dirname(DIR) . '/../web/storage');
        $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter(  \dirname(__DIR__) .'/../web/uploads');
        $filesystem = new \League\Flysystem\Filesystem($adapter);
        return $filesystem;
    }
}


