<?php
include("form.html");
$instruction = (string)$_REQUEST['input'];
$memory = [];//большой массив
$output = '';//вывод
$stack = [];
$openToClose = [];
$closeToOpen = [];
for ($pointerI = 0; $pointerI < strlen($instruction); $pointerI++) {//для квадратных скобок
    if ($instruction[$pointerI] == '[') {
        array_push($stack, $pointerI);
    }
    if ($instruction[$pointerI] == ']') {
        $openPoint = array_pop($stack);
        $openToClose[$openPoint] = $pointerI;
        $closeToOpen[$pointerI] = $openPoint;
    }
}
$pointerM = 0;
for ($pointerI = 0; $pointerI < strlen($instruction); $pointerI++) {
    switch ($instruction[$pointerI]) {
        case '>':
            $pointerM++;
            break;
        case '<':
            $pointerM--;
            break;
        case '+':
            if (!isset($memory[$pointerM]))
                $memory[$pointerM] = 0;
            $memory[$pointerM]++;
            break;
        case '-':
            if (!isset($memory[$pointerM]))
                $memory[$pointerM] = 0;
            $memory[$pointerM]--;
            break;
        case '.':
            $c = chr($memory[$pointerM]);
            $output .= $c;
            break;
        case '[':
            if ($memory[$pointerM] == 0) {
                $pointerI = $openToClose[$pointerI];
            }
            break;
        case ']':
            if ($memory[$pointerM] != 0) {
                $pointerI = $closeToOpen[$pointerI];
            }
            break;
    }
}
echo "<p>" . $output . "</p>";
