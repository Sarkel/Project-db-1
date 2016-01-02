<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 30.12.2015
 * Time: 00:27
 */

namespace App\Models;

use App\Vendor\RandomLib;
use App\Wrappers\ResponseWrapper;
use App\Wrappers\DataBaseResponseWrapper;
use Exception;

class AuthorizationModel
{
    private $tokenLength = 15;
    private $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private static $cookieName = 'Library';
    private function getSecurityToken()
    {
        RandomLib::addRandomLibrary();
        $str = '';
        $max = strlen($this->keyspace) - 1;
        for ($i = 0; $i < $this->tokenLength; ++$i) {
            $str .= $this->keyspace[random_int(0, $max)];
        }
        return $str;
    }

    private function __construct(){}

    public static function logIn($data){
        $auth = new AuthorizationModel();
        if(AuthorizationModel::checkSession()) {
            return new ResponseWrapper(false, 'You are already logged in.');
        } else {
            $userDetail = $data['BodyParams'];
            $email = $userDetail['email'];
            $db = null;
            $resp = null;
            try{
                $db = new DataBase();
                $resp = $db->execute(['id', 'email', 'pwd', 'pwdSeed', 'typ', 'avatar'], 'login_user', $email);
            } catch (Exception $e){
                return new ResponseWrapper(false, $e->getMessage());
            }
            if(count($resp) !== 0){
                $seed = $resp[0]->pwdSeed;
                $pwd = $resp[0]->pwd;
                if(md5($seed + $userDetail['pwd']) === $pwd) {
                    setcookie(AuthorizationModel::$cookieName, $auth->getSecurityToken(), time()+3600);
                    return new ResponseWrapper(true, 'Correct credentials.', [
                        'id' => $resp[0]->id,
                        'email' => $resp[0]->email,
                        'typ' => $resp[0]->typ,
                        'avatar' => $resp[0]->avatar
                    ]);
                } else {
                    return new ResponseWrapper(false, 'Wrong password or login.');
                }
            } else {
                return new ResponseWrapper(false, 'Wrong password or login.');
            }
        }
    }
    
    public static function logOut(){
        return new ResponseWrapper(true, 'Logged out.');
    }
    
    public static function checkSession(){
        $cookie = $_COOKIE[AuthorizationModel::$cookieName];
        if(strlen($cookie) != 0) return true;
        return false;
    }

}