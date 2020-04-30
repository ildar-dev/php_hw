<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include("form.html");
include("AbstractLogger.php");
include("FileLogger.php");
include("BrowserLogger.php");

if (!isset($_REQUEST["format"]))//проверка параметра времени
    $format = AbstractLogger::WITHOUT;
else {
    $format = $_REQUEST["format"];
    switch ($format) {
        case "1":
            $format = AbstractLogger::TIME_DATE;
            break;
        case "2":
            $format = AbstractLogger::TIME;
            break;
        case "3":
            $format = AbstractLogger::WITHOUT;
            break;
    }
}
if (!isset($_REQUEST["text"])||!isset($_REQUEST["log"])||!isset($_REQUEST["path"])) {//проверка текста
    echo "Введите строки";
    return;
}
$textArea = $_REQUEST["text"];
$logType = $_REQUEST["log"];
$path = $_REQUEST["path"];
if ($logType == "file")
    $logger = new FileLogger($path);
else
    $logger = new BrowserLogger();

LogText($logger, $textArea, $format);
function LogText(AbstractLogger $logger, $textArea, $format)
{
    $explode = explode("\n", $textArea);
    foreach ($explode as $line) {
        $flag = " не ";
        $line = trim($line);
        for ($i = 0; $i < mb_strlen($line); $i++)
            if (ctype_upper($line[$i])) {
                $flag = " ";
                break;
            }
        $logger->print("Строка $line{$flag}содержит заглавные буквы", $format);
    }
}

