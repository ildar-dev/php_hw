<?php
$ini = parse_ini_file("index.ini", true);
$input = file($ini["main"]["filename"]);
if(!isset($ini)) {
    echo"не найден index.ini";
    return;
}
if (!$ini["second_rule"]["direction"] == "+" || !$ini["second_rule"]["direction"] == "-") {
    echo "index.ini[second_rule][direction] must be \"+\" or \"-\"";
    return;
}
if (mb_strlen($ini["third_rule"]["delete"]) != 1) {
    echo "index.ini[third_rule][delete] must be char";
    return;
}
foreach ($input as $line) {
    if ($line[0] == $ini["first_rule"]["symbol"])
        if ($ini["first_rule"]["upper"]==="false"||!boolval($ini["first_rule"]["upper"]))
            $line = strtolower($line);
        else
            $line = strtoupper($line);
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
    if ($line[0] == $ini["third_rule"]["symbol"])
        $line = implode("", explode($ini["third_rule"]["delete"], $line));
    echo $line . "</br>";
}