<?php
namespace app\adapters;


use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
class flySystem extends Local
{
    public function adapter(){
        $adapter =  Local(__DIR__.'@web/uploads/local');
        $filesystem =  Filesystem($adapter);
    }

}