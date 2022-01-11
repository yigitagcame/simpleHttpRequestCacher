<?php

require __DIR__.'/vendor/autoload.php';

use App\App;
use App\Services\CacheService;
use App\Services\HttpService ;

$cacheService = new CacheService(__DIR__.'/storage/cache.json');
$httpClient = new HttpService;
$app = new App($cacheService,$httpClient);

$app->run();