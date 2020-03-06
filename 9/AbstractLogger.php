<?php


abstract class AbstractLogger
{
    const TIME = "H:i:s:u";
    const TIME_DATE = "Y-m-d H:i:s:u";
    const WITHOUT = "";

    protected static function addData($format)
    {
        $now = new DateTime();
        return $now->format($format)." ";
    }

    abstract public function print($line, $format);
}