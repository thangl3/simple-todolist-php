<?php
namespace Helper;

trait DataArrayAccessTrait
{
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->data[] = $value;
        } else {
            $this->data[$key] = $value;
        }
    }

    public function offsetGet($key)
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    public function offsetExists($key)
    {
        return $this->has($this->data[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }
}