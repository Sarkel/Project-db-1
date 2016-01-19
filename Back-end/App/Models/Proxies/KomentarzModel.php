<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 19.01.2016
 * Time: 04:08
 */

namespace App\Models\Proxies;


use App\Models\DataBase;
use App\Wrappers\ResponseWrapper;
use Exception;

class KomentarzModel
{
    public static function getAllCommentsByBook($bookId){
        try{
            $uriParam = $bookId['UriParams'][0];
            $db = new DataBase();
            $response = $db->executeFunction("comments_by_book", ['id', 'imie','nazwisko', 'tekst', 'data'], "$uriParam");
            return new ResponseWrapper(true, 'Correct', $response);
        } catch( Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function getAllCommentsByUser($userId){
        try{
            $uriParam = $userId['UriParams'][0];
            $db = new DataBase();
            $response = $db->executeFunction("comments_by_user", ['id', 'tytul','tekst', 'data'], "$uriParam");
            return new ResponseWrapper(true, 'Correct', $response);
        } catch( Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function createComment($comment){
        try{
            $bodyParams = $comment['BodyParams'][0];
            $db = new DataBase();
            $response = $db->insert('$komentarz', $bodyParams);
            return new ResponseWrapper($response);
        } catch(Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }
}