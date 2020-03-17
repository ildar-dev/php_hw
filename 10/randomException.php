<?php
spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $path = $_SERVER['DOCUMENT_ROOT'] ."/". $className . '.php';
    require $path;
});
class randomException
{
    public function __call($method, $args)
    {
            return call_user_func_array($this->$method, $args);
    }

    public function __construct()
    {
        for($i=1;$i<5;$i++)
            eval('$this->rnd'.$i.' = function(){ $number =random_int(0,1);if($number==0)return new Exceptions\Exception'.$i.'();return new \Exceptions\Exception'.($i+1).'();};');
    }
}