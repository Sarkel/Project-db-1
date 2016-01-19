<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 30.12.2015
 * Time: 23:39
 */

namespace App\Models\Proxies;


use App\Wrappers\ResponseWrapper;
use App\Models\DataBase;
use App\Wrappers\WhereConditionWrapper;
use Exception;
class KsiazkaModel
{
    public static function getAllBooks(){
        try{
            $db = new DataBase();
            $response = $db->executeView("all_books", ['id', 'tytul', 'avatarUrl', 'stars']);
            return new ResponseWrapper(true, 'Correct', $response);
        } catch (Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function getSearchBookResult($searchParam){
        try{
            $uriParam = $searchParam['UriParams'][0];
            $db = new DataBase();
            $response = $db->executeFunction("search_books", ['id', 'tytul', 'avatarUrl', 'stars'], "'$uriParam'");
            return new ResponseWrapper(true, 'Correct', $response);
        } catch (Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function getBookDetail($bookId){
        try{
            $uriParam = $bookId['UriParams'][0];
            $db = new DataBase();
            $response = $db->executeFunction("detail_book", ['id', 'tytul','rokWydania', 'isbn', 'avatarUrl', 'wydawnictwoNazwa', 'stars'], "$uriParam");
            $response[0]->setProperty('authors', $db->executeFunction("book_authors", ['id', 'imie','nazwisko', 'kraj', 'nazwaPowiazania'], "$uriParam"));
            $response[0]->setProperty('wyd', $db->executeFunction("book_wyd", ['id', 'nazwa','kraj'], "$uriParam")[0]);
            return new ResponseWrapper(true, 'Correct', $response);
        } catch( Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function addBook($bookDetails){
        try{
            $bodyParams = $bookDetails['BodyParams'][0];
            $db = new DataBase();
            $response = $db->insert('ksiazka', $bodyParams);
            return new ResponseWrapper($response);
        } catch(Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function changeBook($bookDetails){
        try{
            $bodyParams = $bookDetails['BodyParams'][0];
            $uriParam = $bookDetails['UriParams'][0];
            $db = new DataBase();
            $response = $db->update('ksiazka', $bodyParams, new WhereConditionWrapper('id', $uriParam));
            return new ResponseWrapper($response);
        } catch(Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function deleteBook($bookId){
        try{
            $uriParam = $bookId['UriParams'][0];
            $db = new DataBase();
            $response = $db->delete('ksiazka', new WhereConditionWrapper('id', $uriParam));
            return new ResponseWrapper($response);
        } catch(Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }

    public static function borrowBook($details){
        try{
            $bodyParams = $details['BodyParams'][0];
            $db = new DataBase();
            $response = $db->insert('$wypozyczonaKsiazka', $bodyParams);
            return new ResponseWrapper($response);
        } catch(Exception $e){
            return new ResponseWrapper(false, $e->getMessage());
        }
    }
}