<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ob_start();
session_cache_expire(1);
$cache_expire = session_cache_expire();
session_start();
include("2/form.html");
//printLastData();//чтобы узнать предыдущее значение
if (empty($_SESSION["data"])) {//в первый раз
    if (!isset($_REQUEST["input"])) {
        echo "Введите данные";
        exit;
    } else {
        $_SESSION["data"] = $_REQUEST["input"];
        getResponse();
        exit;
    }
} else {
    if (!isset($_REQUEST["input"])) {
        echo "Введите данные";
        exit;
    } else {
        if ($_SESSION["data"] === $_REQUEST["input"]) {
            getResponse();
            exit;
        } else
            echo "Данные не соответствуют предыдущим";
    }
}

function getResponse()
{
    $params = [];
    $params["input"] = $_REQUEST["input"];
    header_remove("Location");
    header("Location: 2/index.php?" . http_build_query($params));
}

function printLastData()
{
    if (!isset($_SESSION["data"]))
        echo "Предыдущего значения нет</br>";
    else
        echo "Предыдущее значение: " . $_SESSION["data"] . "</br>";
}


