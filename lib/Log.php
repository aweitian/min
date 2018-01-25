<?php
/**
 * 2017/5/15 17:36:25
 * config component
 */

namespace lib;


class Log
{
    protected $log_path;
    protected $log_name;

    public function __construct($dir)
    {
        $this->log_path = $dir;
    }

    /**
     * @param $content
     * @return bool
     */
    public function error($content)
    {
        return $this->write($content, "E");
    }

    /**
     * @param $content
     * @return bool
     */
    public function debug($content)
    {
        return $this->write($content, "D");
    }

    /**
     * @param $content
     * @return bool
     */
    public function warning($content)
    {
        return $this->write($content, "W");
    }

    /**
     * @param $content
     * @return bool
     */
    public function info($content)
    {
        return $this->write($content, "I");
    }

    protected function write($content, $level)
    {
        if (is_dir($this->log_path) && is_writable($this->log_path)) {
            $count = file_put_contents($this->getLogPath(), $this->buildLogLine($content, $level), FILE_APPEND);
            return !!$count;
        }
        return false;
    }

    protected function buildLogLine($content, $level)
    {
        return $level . "\t" . date('Y-m-d H:i:s', time()) . "\t" . $content . PHP_EOL;
    }

    /**
     * {}会被替换成时间
     * @param $name
     * @return Log
     */
    public function setLogName($name)
    {
        $this->log_name = strtr($name, array('{}', date('Y-m-d'=> time())));
        return $this;
    }

    /**
     * @return $this
     */
    public function resetLogName()
    {
        $this->log_name = null;
        return $this;
    }

    protected function getLogPath()
    {
        return $this->log_path . DIRECTORY_SEPARATOR .
            (is_null($this->log_name) ? date('Y-m-d', time()) . '.log' : $this->log_name);
    }

}
