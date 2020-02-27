<?php
include("form.html");
function GetString($str)
{
    function generator($str)
    {
        $counter = strlen($str);
        for ($i = 0; $i < strlen($str); $i++) {
            switch ($str[$i]) {
                case 'h':
                    yield '4';
                    break;
                case 'l':
                    yield '1';
                    break;
                case 'e':
                    yield '3';
                    break;
                case 'o':
                    yield '0';
                    break;
                default:
                    $counter--;
                    yield $str[$i];
                    break;
            }
        }
        return $counter;
    }

    $generator = generator($str);
    foreach ($generator as $item) {
        echo $item;
    }
    echo "</br> count : " . $generator->getReturn();
}

GetString($_REQUEST["input"]);