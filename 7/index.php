<?php
include("form.html");
$address = $_REQUEST["address"];
$chPing = $_REQUEST["ping"];
$chTrace = $_REQUEST["trace"];
$os=PHP_OS;
$traceCmd="";
if($os="Darwin")//разные команды для разных ОС
    $traceCmd="traceroute";//MacOS
else
    $traceCmd="tracert";//Windows
if (isset($chPing)) {
    $command = "ping {$address} -c 3  -W 1 -q ";//не уверен, что параметры работают на windows
    $command = escapeshellcmd($command);
    $string = exec($command, $arr);
    $output = implode(" ", $arr);
    preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $output, $matchesIp);//поиск ip
    preg_match("{[0-9]{1,3}\.[0-9]*%}",$output,$matchesPercent);//поиск процента
    echo "ping :</br><b>{$matchesIp[0][0]}</b></br>$matchesPercent[0]</br>";
}
if (isset($chTrace)) {
    $command = "$traceCmd -w 1 -m 4 {$address}";//не уверен, что параметры работают на windows
    $command = escapeshellcmd($command);
    $string = exec($command, $arr);
    $output = implode(" ", $arr);
    preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $output, $matchesIp);//поиск ip
    $ips= implode(" ", $matchesIp[0]);
    echo "trace route :</br><b>".$ips."</b>";
}