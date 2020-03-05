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
    $output = '';
    foreach ($generator as $item)
        $output .= $item;
    return $output . "</br> count : " . $generator->getReturn();
}

if (isset($_REQUEST["input"]))
    echo GetString($_REQUEST["input"]);
else
    echo "Введите данные";