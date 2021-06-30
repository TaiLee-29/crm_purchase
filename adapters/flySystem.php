<?php
namespace app\adapters;


use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;
class flySystem extends Local
{
    public function adapter(): Filesystem
    {
//
        $adapter =  new \League\Flysystem\Adapter\Local(__DIR__);
        return new  \League\Flysystem\Filesystem($adapter);
    }

}