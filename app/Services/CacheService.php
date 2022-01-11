<?php

namespace App\Services;

use App\Services\CacheInterface;
use App\Services\FileService;

class CacheService implements CacheInterface{

    private object $cacheFile;

    public function __construct(string $cacheFilePath){
        $this->cacheFile = new FileService($cacheFilePath);

    }

    public function set(string $key, $value, int $duration){

        [$cacheLine,$cacheIndex] = $this->get($key);

        $structer = [
            'key' => $key,
            'value' => $value,
            'expiry_date' => time() + ($duration * 60)
        ];

        $cache = $this->cacheFile->read();
        $cache[$cacheIndex] = $structer;

        $isWritten = $this->cacheFile->write($cache);

        return $isWritten;

    }


    public function get(string $key) : array{

        $cache = $this->cacheFile->read();;
        $index = -1;
        $cacheLine = [];

        foreach($cache as $record ){
            if($record['key'] == $key){
                $cacheLine = $record;
            }
            $index++;
        }

        return [$cacheLine,$index < 0 ? 0 : $index];
    }

}