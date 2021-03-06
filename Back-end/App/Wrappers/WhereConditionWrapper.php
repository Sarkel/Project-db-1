<?php

/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 26.12.2015
 * Time: 13:19
 */

namespace App\Wrappers;
class WhereConditionWrapper
{
    /**
     * @param $fieldAlias
     * @param $fieldValue
     * @description konstruktor klasy wrappującej parametry klauzuli where zapytania sql
     */
    public function __construct($fieldAlias, $fieldValue)
    {
        $this->fieldValue = $fieldValue;
        $this->fieldAlias = $fieldAlias;
        $this->isSet = is_array($fieldValue);
    }

    /**
     * @return string
     */
    public function getValuesString()
    {
        if ($this->isSet) {
            $returnStatement = '(';
            foreach ($this->fieldValue as $key => $value) {
                if(is_string($value)){
                    $returnStatement .= "'$value',";
                } else {
                    $returnStatement .= "$value,";
                }

            }
            $returnStatement = trim($returnStatement, ',');
            $returnStatement .= ')';
            return $returnStatement;
        } else {
            if(is_string($this->fieldValue)){
                return "'$this->fieldValue;'";
            } else {
                return $this->fieldValue;
            }
        }
    }
}