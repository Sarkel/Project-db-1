<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 01.01.2016
 * Time: 16:51
 */

namespace App\Wrappers;


class EndpointComparerResponseWrapper
{
    public $endpointDescription;
    public $params;

    public function __construct($endpointDescription, $params){
        $this->endpointDescription = $endpointDescription;
        $this->params = $params;
    }
}