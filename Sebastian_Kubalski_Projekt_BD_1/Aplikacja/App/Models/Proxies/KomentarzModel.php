<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 19.01.2016
 * Time: 04:08
 */

namespace App\Models\Proxies;


use App\Models\DataBase;
use App\Wrappers\ResponseWrapper;
use Exception;

class KomentarzModel
{
    /**
     * @param $bookId
     * @return ResponseWrapper
     * @description Metoda pobiera wszystkie komentarze dla wybranej ksi¹¿ki
     */
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

    /**
     * @param $userId
     * @return ResponseWrapper
     * @description Metoda pobiera wszystkie komentarze dla wybranego u¿ytkownika
     */
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

    /**
     * @param $comment
     * @return ResponseWrapper
     * @description Metoda tworzy komentarz
     */
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