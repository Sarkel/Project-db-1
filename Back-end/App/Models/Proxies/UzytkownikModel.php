<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 10.01.2016
 * Time: 23:44
 */

namespace App\Models\Proxies;

use App\Models\DataBase;
use App\Wrappers\ResponseWrapper;
use Exception;

class UzytkownikModel
{
    public static function getAllUsers(){
        try{
            $db = new DataBase();
            $response = $db->executeView("all_users", ['id', 'tytul', 'avatarUrl', 'stars']);
            return new ResponseWrapper(true, 'Correct', $response);
        } catch (Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }
}