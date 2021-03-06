<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 29.12.2015
 * Time: 22:43
 */

define('__ROOT__', dirname(dirname(__FILE__)));
/**
 * @param $className
 * @description funkcja s�u��ca do �adowania odpowiednich klas
 */
function __autoload($className) {
    $ds = '\\';
    $file = __ROOT__ . $ds . str_replace('\\', $ds, $className) . '.php';
    if(is_readable($file)) require_once $file;
}

use App\Models\ApiModel;

$api = new ApiModel();
$api->run();