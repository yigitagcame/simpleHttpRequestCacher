<?php

use PHPUnit\Framework\TestCase;
use App\Services\CacheService;

class CacheServiceTest extends TestCase{

    /** @test */

    public function a_content_can_be_cached_and_read_from_the_cache(){

        $cacheFilePath = __DIR__.'/../storage/testCache.json';

        $cache = new CacheService($cacheFilePath);

        $key = rand(10000,9999999);

        $duration = 5; // in mins

        $isCached = $cache->set($key, $this->sampleCacheFileContent(), $duration);

        $this->assertTrue($isCached);

        [$cachedLine,$index] = $cache->get($key);

        $this->assertEquals($this->sampleCacheFileContent(),$cachedLine['value']);


    }

    private function sampleCacheFileContent(){
        $content = '{"key":"cb6fdbb7908b6a8ca13aeba3adcd0853","value":[{"id":"STANDARD","name":"Flat Rate (Estimated delivery: Dec 31\u2060\u2013Jan  6) ","rate":"5.49","currency":"USD","minDeliveryDays":4,"maxDeliveryDays":8}],"expiry_date":1640356335}';
        return json_decode($content, true);
    }

}