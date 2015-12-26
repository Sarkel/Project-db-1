<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 26.12.2015
 * Time: 15:10
 */

define('__ROOT__', dirname(dirname(__FILE__)));
function __autoload($className) {
    $ds = '\\';
    $file = __ROOT__ . $ds . str_replace('\\', $ds, $className) . '.php';
    if(is_readable($file)) require_once $file;
}