<?php

namespace App\Services;

use phpDocumentor\Reflection\Types\Boolean;

class FileService{

    private string $path;

    public function __construct($path){
        $this->path = $path;
    }

    public function write(array $content) : bool{
        $fp = fopen($this->path, 'w');
        $fileWrite = fwrite($fp, json_encode($content));
        fclose($fp);
        
        return is_numeric($fileWrite);
    }


    public function read() : array{
        $cacheFile = file_get_contents($this->path);

        return json_decode($cacheFile, true);
    }



}