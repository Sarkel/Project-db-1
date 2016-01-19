<?php

/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 21.12.2015
 * Time: 23:16
 */

namespace App\Models;

//standard classes
use PDO;
use Exception;
use PDOException;

//custom classes
use App\Exceptions\DateBaseConnectionException;
use App\Exceptions\CustomException;
use App\Exceptions\DateBaseDMLException;
use App\Exceptions\DateBaseSelectException;
use App\Wrappers\DataBaseSettingsWrapper;
use App\Wrappers\DataBaseFieldsWrapper;
use App\Wrappers\WhereConditionWrapper;
use App\Wrappers\DataBaseResponseWrapper;
class DataBase
{
    private $settings;
    private $db;

    /**
     * @throws CustomException
     * @description konstruktor, rozpoczyna po³¹czenie z baz¹ danych oraz ustawia odpowiednie parametry po³¹czenia
     */
    public function __construct()
    {
        try {
            $content = file_get_contents('./Mocks/DateBaseSettings.json');
            $this->settings = new DataBaseSettingsWrapper(json_decode($content, true));
            $this->db = $this->connect();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DateBaseConnectionException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @description destruktor, koñczy po³¹czenie z baz¹ danych
     */
    public function __destruct()
    {
        $this->db = null;
    }

    /**
     * @return PDO
     * @description metoda tworzy nowy obiekt PDO reprezentuj¹cy po³¹czenie z baz¹ danych
     */
    private function connect()
    {
        $dbName = $this->settings->dbName;
        $host = $this->settings->host;
        $dbUser = $this->settings->dbUser;
        $dbPwd = $this->settings->dbPwd;
        return new PDO("pgsql:dbname=$dbName;host=$host", $dbUser, $dbPwd);
    }

    /**
     * @param $tableAlias
     * @param $params
     * @return bool
     * @throws CustomException
     * @description metoda odpowiada za dodawanie nowych wartoœci do bazy danych
     */
    public function insert($tableAlias, $params)
    {
        if (!$this->isValidString($tableAlias) || !$this->isValidArray($params)) throw new CustomException('Invalid input params.');
        try {
            $fields = '';
            $values = '';
            $tableDescription = DataBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            foreach ($params as $key => $value) {
                $fields .= "$tableFields[$key],";
                $values .= ":$key,";
            }
            $fields = trim($fields, ',');
            $values = trim($values, ',');
            $statement = $this->db->prepare("INSERT INTO $tableName($fields) VALUES($values);");

            $this->db->beginTransaction();
            $statement->execute($params);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $tableAlias
     * @param null $whereConditions
     * @return bool
     * @throws CustomException
     * @description metoda s³u¿y do usuwania recordów z bazy danych
     */
    public function delete($tableAlias, $whereConditions = null)
    {
        if (!$this->isValidString($tableAlias)) throw new CustomException('Invalid input params.');
        try {
            $tableDescription = DataBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            $whereString = $this->setWhereCondition($whereConditions, $tableFields);
            $statement = $this->db->prepare("DELETE FROM $tableName $whereString;");

            $this->db->beginTransaction();
            $statement->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $tableAlias
     * @param $setParams
     * @param null $whereConditions
     * @return bool
     * @throws CustomException
     * @description metoda s³u¿y do updatowania recordów w bazie danych
     */
    public function update($tableAlias, $setParams, $whereConditions = null)
    {
        if(!$this->isValidString($tableAlias) || !$this->isValidArray($setParams)) throw new CustomException('Invalid input params.');
        try {
            $tableDescription = DataBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            $whereString = $this->setWhereCondition($whereConditions, $tableFields);
            $setString = '';
            foreach($setParams as $key => $value){
                if(is_string($value)){
                    $setString .= "$tableFields[$key]='$value',";
                } else {
                    $setString .= "$tableFields[$key]=$value,";
                }
            }
            $setString = trim($setString, ',');
            $statement = $this->db->prepare("UPDATE $tableName SET $setString $whereString;");
            $this->db->beginTransaction();
            $statement->execute();
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $tableAlias
     * @param null $fields
     * @param null $whereCondition
     * @param null $otherOptions
     * @return array
     * @throws CustomException
     * @description metoda wykonuje zapytanie SQL do bazy, jedynie dla pól z jednej tabeli
     */
    public function select($tableAlias, $fields = null, $whereCondition = null, $otherOptions = null)
    {
        try {
            $tableDescription = DataBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            $fieldsString = '';
            if(is_null($fields)){
                $fieldsString = '*';
            } elseif($this->isValidArray($fields)) {
                foreach($fields as $field){
                    $fieldsString .= "$field,";
                }
                $fieldsString = trim($fieldsString, ',');
            } else{
                throw new CustomException('Invalid input params.');
            }
            $result = [];
            foreach($this->db->query("SELECT $fieldsString FROM $tableName $whereCondition $otherOptions") as $row){
                $rowWrapper = new DataBaseResponseWrapper();
                foreach($tableFields as $alias => $original){
                    foreach($row as $key => $value){
                        if($original === $key) $rowWrapper->setProperty($alias, $value);
                    }
                }
                array_push($result, $rowWrapper);
            }
            return $result;
        } catch (PDOException $e) {
            throw new DateBaseSelectException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $viewName
     * @param $fields
     * @return array
     * @throws CustomException
     * @description metoda s³u¿y do wykonywania zapytañ o widoki
     */
    public function executeView($viewName, $fields){
        if(!$this->isValidArray($fields) || !$this->isValidString($viewName)) throw new CustomException('Invalid input params.');
        try {
            $resp = [];
            foreach($this->db->query("SELECT * FROM Biblioteka.$viewName") as $row){
                $el = new DataBaseResponseWrapper();
                for($i=0; $i<count($fields); $i++){
                    $el->setProperty($fields[$i], $row[$i]);
                }
                array_push($resp, $el);
            }
            return $resp;
        } catch (PDOException $e) {
            throw new DateBaseSelectException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $function
     * @param $fields
     * @param null $param
     * @return array
     * @throws CustomException
     * @description metoda wykonuje procedury sk³adowane
     */
    public function executeFunction($function, $fields, $param = null){
        if(!$this->isValidArray($fields) || !$this->isValidString($function)) throw new CustomException('Invalid input params.');
        try {
            $resp = [];
            foreach($this->db->query("SELECT Biblioteka.$function($param)") as $row){
                $el = new DataBaseResponseWrapper();
                $row = str_replace('(', '', $row[$function]);
                $row = str_replace(')', '', $row);
                $row = explode(',', $row);
                for($i=0; $i<count($fields); $i++){
                    $el->setProperty($fields[$i], $row[$i]);
                }
                array_push($resp, $el);
            }
            return $resp;
        } catch (PDOException $e) {
            throw new DateBaseSelectException($e->getMessage(), $e->getCode(), $e);
        } catch (Exception $e) {
            throw new CustomException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $string
     * @return bool
     * @description walidacja stringów
     */
    private function isValidString($string)
    {
        return $string != null && is_string($string);
    }

    /**
     * @param $array
     * @return bool
     * @description walidacja tabel
     */
    private function isValidArray($array)
    {
        return $array != null && is_array($array) && count($array) != 0;
    }

    /**
     * @param $object
     * @return bool
     * @description walidacja obiektów
     */
    private function isValidObject($object)
    {
        return $object != null && is_object($object);
    }

    /**
     * @param $whereConditions
     * @param $tableFields
     * @return mixed|string
     * @description ustawanie odpowiedniej klauzuli WHERE dla podanego obiektu i pól
     */
    private function setWhereCondition($whereConditions, $tableFields){
        $whereString = '';
        if ($this->isValidArray($whereConditions)) {
            $whereString .= "WHERE ";
            foreach ($whereConditions as $value) {
                $fieldName = $tableFields[$value->fieldAlias];
                $fieldValues = $value->getValuesString();
                if($this->isValidObject($value) && $value->isSet){
                    $whereString .= "$fieldName IN $fieldValues,";
                } elseif($this->isValidObject($value)){
                    $whereString .= "$fieldName = '$fieldValues',";
                }
            }
            return str_replace(',', ' AND ', trim($whereString, ','));
        } elseif($this->isValidString($whereConditions)){
            return "WHERE " . $whereConditions;
        }
        return '';
    }
}