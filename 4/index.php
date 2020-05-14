<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include("form.html");
if (!isset($_REQUEST["area"])) {
    echo "Введите данные";
    return;
}
$textArea = $_REQUEST["area"];
$arrayOfLines = explode("\n", $textArea);
$data = [];
$sum = 0;
foreach ($arrayOfLines as $line) {
    $words = explode(" ", $line);
    $weight = (int)array_pop($words);
    $sum += $weight;
    $obj = [];
    $obj["text"] = implode(" ", $words);
    $obj["weight"] = $weight;
    array_push($data, $obj);
}
foreach ($data as &$obj)
    $obj["probability"] = $obj["weight"] / $sum;
$resultArray = [];
$resultArray["sum"] = $sum;
$resultArray["data"] = $data;
echo json_encode($resultArray, JSON_UNESCAPED_UNICODE) . "</br>";
function generator($resultArray)
{
    $sum = $resultArray["sum"];
    $data = $resultArray["data"];
    for($j=0;$j<10000;$j++) {
        $rnd = mt_rand(0, $sum - 1);
        for ($i = 0; $i < count($data); $i++) {
            $rnd -= $data[$i]["weight"];
            if ($rnd < 0) {
               yield  $data[$i]["text"];
                break;
            }
        }
    }
}

function checkGenerator($resultArray)
{
    $lineToCount = [];
    $checkedArray = [];
        $generator = generator($resultArray);
        foreach ($generator as $line) {
            if (!isset($lineToCount[$line]))
                $lineToCount[$line] = 0;
            $lineToCount[$line]++;
    }
    foreach ($lineToCount as $line => $count) {
        $obj = [];
        $obj["text"] = $line;
        $obj["count"] = $count;
        $obj["calculated_probability"] = $count / 10000;
        array_push($checkedArray, $obj);
    }
    echo json_encode($checkedArray, JSON_UNESCAPED_UNICODE);
}

checkGenerator($resultArray);
