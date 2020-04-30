<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include("form.html");
if (!isset($_REQUEST["textarea"])) {
    echo "Введите данные";
    return;
}
$textArea = $_REQUEST["textarea"];
$split = explode("\n", $textArea);
$arrOfWords = [];
for ($i = 0; $i < count($split); $i++) {
    $arrOfWords[$i] = explode(" ", $split[$i]);
    if (count($arrOfWords[$i]) <= 1) {//иначе невозможна сортировка по второму слову
        echo "строка №" . ($i + 1) . " имеет менее двух слов</br>Введите корректные данные";
        return;
    }
    $shuffled = $arrOfWords[$i];
    shuffle($shuffled);
    $arrOfWords[$i + count($split)] = $shuffled;
}
uasort($arrOfWords, function ($t1, $t2) {
    return $t1[1] <=> $t2[1];
});
foreach ($arrOfWords as $line)
    echo implode(" ", $line) . "</br>";
