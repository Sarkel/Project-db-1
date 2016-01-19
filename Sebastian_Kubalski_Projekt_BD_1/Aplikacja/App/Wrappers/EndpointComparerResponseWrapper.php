<?php
/**
 * Created by PhpStorm.
 * User: Sebastian Kubalski
 * Date: 01.01.2016
 * Time: 16:51
 */

namespace App\Wrappers;


class EndpointComparerResponseWrapper
{
    public $endpointDescription;
    public $params;

    /**
     * @param $endpointDescription
     * @param $params
     * @description wrapper u�ywany przy wybieraniu metody i klasy na podstawie endpointu zapytania ajaxowego
     */
    public function __construct($endpointDescription, $params){
        $this->endpointDescription = $endpointDescription;
        $this->params = $params;
    }
}