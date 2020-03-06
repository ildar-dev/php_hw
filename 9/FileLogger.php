<?php
class FileLogger extends AbstractLogger
{
    public $path;
    private $descriptor;
    function __construct($path)
    {
        $this->path=$path;
        $this->descriptor=fopen($path,"w");
    }

    function __destruct()
    {
        $flag=fclose($this->descriptor);
        if(!$flag)
            echo "Закрытие файла {$this->path} не удалось";
    }

    public function print($line,$format=self::WITHOUT)
    {
        fwrite($this->descriptor,self::addData($format).$line."\n");
    }
}