<?php
include("form.html");
$textArea = $_REQUEST["area"];
if ($textArea == null) {
    echo "Введите данные";
    return;
}
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
    $rnd = mt_rand(0, $sum - 1);
    for ($i = 0; $i < count($data); $i++) {
        $rnd -= $data[$i]["weight"];
        if ($rnd < 0) {
            return $data[$i]["text"];
            break;
        }
    }
    return false;
}

function checkGenerator($resultArray)
{
    $lineToCount = [];
    $checkedArray = [];
    for ($i = 0; $i < 10000; $i++) {
        $str = generator($resultArray);
        if (!isset($lineToCount[$str]))
            $lineToCount[$str] = 0;
        $lineToCount[$str]++;
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
