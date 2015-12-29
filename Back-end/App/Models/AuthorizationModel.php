<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 30.12.2015
 * Time: 00:27
 */

namespace App\Models;

use App\Vendor\RandomLib;
class AuthorizationModel
{
    private static $tokenLength =25;
    private static $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private function getSecurityToken()
    {
        RandomLib::addRandomLibrary();
        $str = '';
        $max = strlen(AuthorizationModel::$keyspace) - 1;
        for ($i = 0; $i < AuthorizationModel::$tokenLength; ++$i) {
            $str .= AuthorizationModel::$keyspace[random_int(0, $max)];
        }
        return $str;
    }
}