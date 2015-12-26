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
use App\Wrappers\DateBaseSettingsWrapper;
use App\Wrappers\DateBaseFieldsWrapper;
use App\Wrappers\WhereConditionWrapper;
class DateBase
{
    private $settings;
    private $db;

    public function __construct()
    {
        try {
            $content = file_get_contents('./Mocks/ServerSiteSettings.json');
            $this->settings = new DateBaseSettingsWrapper(json_decode($content, true));
            $this->db = $this->connect();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new DateBaseConnectionException();
        } catch (Exception $e) {
            throw new CustomException();
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
        if (!$this->isValidString($tableAlias) || !$this->isValidArray($params)) throw new CustomException();
        try {
            $fields = '';
            $values = '';
            $tableDescription = DateBaseFieldsWrapper::getDateBaseProperties($tableAlias);
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
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException();
        }
    }

    public function delete($tableAlias, $whereConditions = null)
    {
        if (!$this->isValidString($tableAlias)) throw new CustomException();
        try {
            $tableDescription = DateBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            $whereString = $this->setWhereCondition($whereConditions, $tableFields);
            $statement = $this->db->prepare("DELETE FROM $tableName $whereString;");

            $this->db->beginTransaction();
            $statement->execute();
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException();
        }
    }

    public function update($tableAlias, $setParams, $whereConditions = null)
    {
        if(!$this->isValidString($tableAlias) || !$this->isValidArray($setParams)) throw new CustomException();
        try {
            $tableDescription = DateBaseFieldsWrapper::getDateBaseProperties($tableAlias);
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
        } catch (PDOException $e) {
            $this->db->rollBack();
            throw new DateBaseDMLException($e->getMessage());
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new CustomException();
        }
    }

    public function select($tableAlias, $fields, $whereCondition = null)
    {
        //if($this->isValidString($query)) throw new CustomException();
        try {

        } catch (PDOException $e) {
            throw new DateBaseSelectException();
        } catch (Exception $e) {
            throw new CustomException();
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
                $innerValue = new WhereConditionWrapper($value->fieldAlias, $value->fieldValue);
                $fieldValues = $innerValue->getValuesString();
                if($this->isValidObject($value) && $innerValue->isSet){
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