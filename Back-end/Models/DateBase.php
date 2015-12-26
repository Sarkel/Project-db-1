<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:16
 */
class DateBase
{
    private $settings;
    private $db;

    public function __construct()
    {
        try {
            $content = file_get_contents('./ServerSiteSettings.json');
            $this->settings = new DateBaseSettingsWrapper(json_decode($content, true));
            $this->db = $this->connect();
        } catch (PDOException $e) {
            throw new DateBaseConnectionException();
        } catch (Exception $e) {
            throw new CustomException();
        }
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
        //if (!$this->isValid($tableAlias, $params)) throw new CustomException();
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
            $statement = $this->db->prepare("INSERT INTO $tableName($fields) VALUES($values)");

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

    public function delete($tableAlias, $whereCondition)
    {
        //if (!$this->isValidDelete($tableAlias, $whereCondition)) throw new CustomException();
        try {
            $tableDescription = DateBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            foreach ($params as $key => $value) {
                $fields .= "$tableFields[$key]=:$key, ";
            }
            $fields = trim($fields, ',');
            $fields =
            $statement = $this->db->prepare("DELETE FROM $tableName WHERE $fields");
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

    public function update($tableAlias, $params, $selectParams)
    {
        //if (!$this->isValid($tableAlias, $params) && !$this->isValidUpdate($selectParams)) throw new CustomException();
        try {
            $tableDescription = DateBaseFieldsWrapper::getDateBaseProperties($tableAlias);
            $tableName = $tableDescription->tableName;
            $tableFields = $tableDescription->tableFields;
            $query = "UPDATE $tableName SET ";
            $allParams = $params;
            foreach($params as $key => $value){
                $query .= "$tableFields[$key]=$key,";
            }
            $query = trim($query);
            $query .= ' WHERE ';
            foreach($selectParams as $key => $value){
                $newKey = $key . 's';

            }
            $statement = $this->db->prepare($query);
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

    public function select($query)
    {
        //if (!$this->isValidSelect($query)) throw new CustomException();
        try {

        } catch (PDOException $e) {
            throw new DateBaseSelectException();
        } catch (Exception $e) {
            throw new CustomException();
        }
    }

    private function isValid($tableAlias, $params)
    {
        return $tableAlias != null && $params != null && is_array($params) && count($params) != 0 && is_string($tableAlias) ? true : false;
    }

    private function isValidUpdate($selectParam)
    {
        return $selectParam != null && is_array($selectParam) && count($selectParam) != 0 ? true : false;
    }

    private function isValidSelect($query){
        return $query != null && is_string($query) ? true : false;
    }

    private function isValidDelete($tableAlias, $whereCondition){
        return $tableAlias != null && is_string($tableAlias) && $whereCondition != null && is_string($whereCondition) ? true : false;
    }
}