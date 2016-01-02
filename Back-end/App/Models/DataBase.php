<?php

/**
 * Created by PhpStorm.
 * User: sebas
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

    public function __destruct()
    {
        $this->db = null;
    }

    private function connect()
    {
        $dbName = $this->settings->dbName;
        $host = $this->settings->host;
        $dbUser = $this->settings->dbUser;
        $dbPwd = $this->settings->dbPwd;
        return new PDO("pgsql:dbname=$dbName;host=$host", $dbUser, $dbPwd);
    }

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

    public function execute($fields, $functionName, $param = null){
        if(!$this->isValidArray($fields) || !$this->isValidString($functionName)) throw new CustomException('Invalid input params.');
        try {
            $query = "SELECT Biblioteka.$functionName";
            if($param === null) {
                $query .= "()";
            } else {
                $query .= "($param)";
            }
            $resp = [];
            foreach($this->db->query($query) as $row){
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

    private function isValidString($string)
    {
        return $string != null && is_string($string);
    }

    private function isValidArray($array)
    {
        return $array != null && is_array($array) && count($array) != 0;
    }

    private function isValidObject($object)
    {
        return $object != null && is_object($object);
    }

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