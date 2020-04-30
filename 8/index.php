<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include("form.html");
$now = new DateTime();
$now->setTimezone(new DateTimeZone("Europe/Moscow"));
if (!isset($_REQUEST["m"])) {
    $month = $now->format("m");
    $date = new DateTime("{$now->format("y-m")}-01 00:00:00", new DateTimeZone("Europe/Moscow"));
} else {
    $month = $_REQUEST["m"];
    $date = new DateTime("{$now->format("y")}-{$month}-01 00:00:00", new DateTimeZone("Europe/Moscow"));
}
$calendar = [];
$step = new DateInterval('P1D');
$period = new DatePeriod($date, $step, 32);
$weekCount = 0;
$calendar[-1] = ["ПН", "ВТ", "СР", "ЧТ", "ПТ", "СБ", "ВС"];
$calendar[0] = array_fill(0, 7, "");
foreach ($period as $datetime) {
    $dayWeekMonth = explode(" ", $datetime->format("d w m"));
    $dayWeekMonth[1] = ($dayWeekMonth[1] + 6) % 7;//иначе 0-воскресенье
    if ($dayWeekMonth[2] != $date->format("m"))
        break;
    $calendar[$weekCount][$dayWeekMonth[1]] = $dayWeekMonth[0];
    if ($dayWeekMonth[1] == 6) {
        $weekCount++;
        $calendar[$weekCount] = array_fill(0, 7, "");
    }
}
$output=$date->format("F");
$output .= "<table>";
foreach ($calendar as $week) {
    $output .= "<tr>";
    for ($i = 0; $i < count($week); $i++) {
        $color = "'#f0f8ff'";
        $style = "";
        if ($i >= 5)
            $color = "'#ff4500'";
        $cell = $week[$i];
        if ($week[$i] == $now->format("d"))
            $cell = "<b>" . $cell . "</b>";
        $cell = "<td bgcolor={$color} {$style}>$cell</td>";
        $output .= $cell;
    }
    $output .= "</tr>";
}
$output .= "</table>";
echo $output;