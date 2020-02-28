<?php
include("form.html");
$textArea = $_REQUEST["textarea"];
$split = explode("\n", $textArea);
$arrOfWords = [];
for ($i = 0; $i < count($split); $i++) {
    $arrOfWords[$i] = explode(" ", $split[$i]);
    $shuffled = $arrOfWords[$i];
    shuffle($shuffled);
    $arrOfWords[$i + count($split)] = $shuffled;
}
uasort($arrOfWords, function ($t1, $t2) {
    return $t1[1] <=> $t2[1];
});
foreach ($arrOfWords as $line) {
    echo implode(" ",$line)."</br>";
}
