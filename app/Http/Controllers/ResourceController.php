<?php
namespace app\Http\Controllers;

class ResourceController
{

    private static $URL_PATTERN = '/^\/v([0-9]{1}|[0-9]{2})\/.*/';

    private static $URL_PATTERN_INTO = '/v([0-9]{1}|[0-9]{2})/';

    public static function getController($class)
    {
        $url = isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:null;

        if (preg_match(ResourceController::$URL_PATTERN, $url)) {

            preg_match(ResourceController::$URL_PATTERN_INTO, $url, $resultMatch);

            $class = $resultMatch[0] . "\\" . $class;
        } else {
            $class = "v1\\" . $class;
        }

        return $class;
    }
}