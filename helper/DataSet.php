<?php
namespace Helper;

class DataSet
{
    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }
}