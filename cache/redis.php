<?php
require_once __DIR__. '/../vendor/autoload.php';
use Predis\Client;

try {
    if (class_exists('Predis\Client')) {
        $redis = new Client([
            'scheme'=> 'tcp',
            'host'=> '127.0.0.1',
            'port'=> 6379
        ]);
    } else {
        $redis = null;
    }
} catch (\Exception $e) {
    $redis = null;
}