<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
spl_autoload_register(function ($className) {
    $path = str_replace("\\", DIRECTORY_SEPARATOR,$_SERVER['DOCUMENT_ROOT']."\\".$className.'.php');
    require $path;
});
$rnd = new randomException();
foreach ($rnd as $item) {
    try {
        throw $item();
    } catch (\Exceptions\Exception5 $e) {//можно через eval
        echo "Ошибка №5</br>";
    } catch (\Exceptions\Exception4 $e) {
        echo "Ошибка №4</br>";
    } catch (\Exceptions\Exception3 $e) {
        echo "Ошибка №3</br>";
    } catch (\Exceptions\Exception2 $e) {
        echo "Ошибка №2</br>";
    } catch (\Exceptions\Exception1 $e) {
        echo "Ошибка №1</br>";
    }
}