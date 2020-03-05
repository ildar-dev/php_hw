<?php
include("form.html");
$password = $_REQUEST["password"];
if($password==null)
{
    echo "Введите пароль";
    return;
}
$warning = "<span style=\"color: red; \">пароль должен :</br> ";
$isCorrect = true;
$categories = [];
$categories["[a-z]"] = "латинские строчные буквы";
$categories["[A-Z]"] = "латинские прописные буквы";
$categories["[0-9]"] = "цифры";
$categories["[%$#_*]"] = "специальные символы %$#_*";
if (strlen($password) < 10) {
    $warning .= "иметь не менее 10 символов</br>";
    $isCorrect = false;
}
foreach ($categories as $pattern => $name) {
    if (!preg_match("{.*" . $pattern . ".*" . $pattern . ".*}", $password)) {
        $warning .= "содержать хотя бы 2 " . $name . "</br>";
        $isCorrect = false;
    }
    if (preg_match("{.*" . $pattern . "{3,}.*}", $password)) {
        $warning .= "не содержать " . $name . " 3 раза подряд</br>";
        $isCorrect = false;
    }
}
if ($isCorrect)
    echo "<span style=\"color: green; \">успех!</span>";
else
    echo $warning . "</span>";
