<?php
class BrowserLogger extends AbstractLogger
{
    public function print($line, $format)
    {
        echo self::addData($format).$line."</br>";
    }
}