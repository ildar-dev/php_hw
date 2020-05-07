<?php

/**
 * File Doc Comment
 *
 * PHP version 7
 *
 * @category Home_Work
 * @package  Does_Not_Exist
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  does not exist
 * @link     http://localhost/
 */

namespace Classes;

use DateTime;
use DateTimeZone;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 *  Logger Class Comment
 *
 * Logger Class implemented LoggerInterface
 *
 * @category Home_Work
 * @package  Does_Not_Exist
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  does not exist
 * @link     http://localhost/
 */
class Logger implements LoggerInterface
{
    private $_jsonObject = [];

    private $_path;
    private $_descriptor;

    /**
     * Constructor
     *
     * @param $path string  path of json file
     */
    function __construct($path)
    {
        $this->_path = $path;
        $this->_descriptor = fopen($path, "w");
    }
    /**
     * Destructor
     *
     * @throws Exception      throw \\Exception
     *
     * @return void
     */
    function __destruct()
    {
        $flag = fclose($this->_descriptor);
        if (!$flag) {
            throw new Exception("cannot close file ".$this->_path);
        }
    }
    /**
     * Save Json function
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function saveJson()
    {
        fwrite($this->_descriptor, json_encode($this->_jsonObject));
    }
    /**
     * Emergency function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message);
    }
    /**
     * Alert function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message);
    }
    /**
     * Critical function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message);
    }
    /**
     * Error function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message);
    }
    /**
     * Debug function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message);
    }

    /**
     * Debug function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @throws Exception      don't throws Exception
     *
     * @return void
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message);
    }

    /**
     * Debug function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @return void
     * @throws Exception      don't throws Exception
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message);
    }


    /**
     * Debug function
     *
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @return void
     * @throws Exception      don't throws Exception
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message);
    }


    /**
     * Log function
     *
     * @param mixed  $level   level of message
     * @param string $message string of message
     * @param array  $context any parameters for logging
     *
     * @return void
     * @throws Exception
     */
    public function log($level, $message, array $context = array())
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone("Europe/Moscow"));
        $obj = [];
        $obj["type"] = $level;
        $obj["content"] = $message;
        $obj["time"] = $now->format("H:i:s");
        array_push($this->_jsonObject, $obj);
    }
}