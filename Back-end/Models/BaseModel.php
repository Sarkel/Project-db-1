<?php
/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 21.12.2015
 * Time: 23:16
 */

class BaseModel
{
    protected $settings;

    function __construct(){
        $content = file_get_contents('./ServerSiteSettings.json');
        $this -> settings = new DateBaseSettingsWrapper(json_decode($content, true));
    }
}