<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include("form.html");

if (!isset($_REQUEST["address"]) || !isset($_REQUEST["ping"]) || !isset($_REQUEST["trace"])) {
    "Введите данные";
    return;
}
$address = $_REQUEST["address"];
$chPing = $_REQUEST["ping"];
$chTrace = $_REQUEST["trace"];
$os = PHP_OS;
$traceCmd = "";
if ($os = "Darwin")//разные команды для разных ОС
    $traceCmd = "traceroute";//MacOS
else
    $traceCmd = "tracert";//Windows

$command = "ping {$address} -c 3  -W 1 -q ";//не уверен, что параметры работают на Windows
$command = escapeshellcmd($command);
$string = exec($command, $arr);
$output = implode(" ", $arr);
preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $output, $matchesIp);//поиск ip
preg_match("{[0-9]{1,3}\.[0-9]*%}", $output, $matchesPercent);//поиск процента
$percent = (100 - floatval($matchesPercent[0])) . "%";//на маке указывается процент неудач,не уверен как на Windows
echo "ping :</br><b>{$matchesIp[0][0]}</b></br>$percent</br>";

$command = "$traceCmd -w 1 -m 5 {$address}";//не уверен, что параметры работают на Windows
$command = escapeshellcmd($command);
$string = exec($command, $arr);
$output = implode(" ", $arr);
preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $output, $matchesIp);//поиск ip
$ips = implode(" ", $matchesIp[0]);
echo "trace route :</br><b>" . $ips . "</b>";
