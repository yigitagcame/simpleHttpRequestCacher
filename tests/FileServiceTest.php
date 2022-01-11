<?php

use PHPUnit\Framework\TestCase;
use App\Services\FileService;

class FileTest extends TestCase{

    /** @test */

    public function a_line_of_content_can_be_written_and_read_in_a_file(){

        $cacheFilePath = __DIR__.'/../storage/testFile.json';

        $file = new FileService($cacheFilePath);

        $writeFile = $file->write($this->sampleCacheFileContent());

        $this->assertTrue($writeFile);

        $fileContent = $file->read();

        $this->assertEquals($this->sampleCacheFileContent(),$fileContent);

    }

    private function sampleCacheFileContent(){
        $content = '{"key":"cb6fdbb7908b6a8ca13aeba3adcd0853","value":[{"id":"STANDARD","name":"Flat Rate (Estimated delivery: Dec 31\u2060\u2013Jan  6) ","rate":"5.49","currency":"USD","minDeliveryDays":4,"maxDeliveryDays":8}],"expiry_date":1640356335}';
        return json_decode($content, true);
    }

}