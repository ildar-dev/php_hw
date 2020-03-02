<?php
$ini = parse_ini_file("index.ini", true);
$input = file($ini["main"]["filename"]);
$allIsCorrect = true;
if (!settype($ini["first_rule"]["upper"], "bool")) {
    echo "index.ini[first_rule][upper] must be bool";
    $allIsCorrect = false;
}

if (!$ini["second_rule"]["direction"] == "+" || !$ini["second_rule"]["direction"] == "-") {
    echo "index.ini[second_rule][direction] must be \"+\" or \"-\"";
    $allIsCorrect = false;
}
if (strlen($ini["third_rule"]["delete"]) != 1) {
    echo "index.ini[third_rule][delete] must be char";
    $allIsCorrect = false;
}
if ($allIsCorrect) {
    foreach ($input as $line) {
        if ($line[0] == $ini["first_rule"]["symbol"]) {
            if ($ini["first_rule"]["upper"])
                $line = strtoupper($line);
            else
                $line = strtolower($line);
        }
        if ($line[0] == $ini["second_rule"]["symbol"]) {
            $number = 0;
            if ($ini["second_rule"]["direction"] == "+")
                $number = 1;
            if ($ini["second_rule"]["direction"] == "-")
                $number = -1;
            for ($i = 0; $i < strlen($line); $i++)
                if (ctype_digit($line[$i]))
                    $line[$i] = ((int)$line[$i] + $number) % 10;
        }
        if ($line[0] == $ini["third_rule"]["symbol"]) {

            $line = implode("", explode($ini["third_rule"]["delete"], $line));
        }
        echo $line . "</br>";
    }
}