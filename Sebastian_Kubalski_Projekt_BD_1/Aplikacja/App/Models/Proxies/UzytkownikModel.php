<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
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
            $response = $db->executeView("all_users", ['id', 'email', 'nazwisko', 'imie', 'avatar', 'nazwa', 'aktywny']);
            return new ResponseWrapper(true, 'Correct', $response);
        } catch (Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function getUserDetail($userId){
        try{
            $uriParam = $userId['UriParams'][0];
            $db = new DataBase();
            $response = $db->executeFunction("user_detail", ['id', 'email','nazwisko', 'imie', 'avatar',
                'ulica', 'numerDomu', 'numerMieszkania', 'kodPocztowy', 'miejscowosc', 'kraj',
                'nazwa', 'komorka', 'stacjonarny', 'aktywny', 'debet'], "$uriParam");
            return new ResponseWrapper(true, 'Correct', $response);
        } catch( Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }
}