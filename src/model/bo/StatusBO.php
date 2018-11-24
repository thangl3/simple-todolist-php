<?php
namespace App\Model\BO;

use App\Model\Bean\Status;

class StatusBO
{
    private $status;

    public function __construct()
    {
        $this->status = new Status();
    }

    public function getAll() : array
    {
        return $this->status->getAll();
    }

    public function getByKey(int $key) : string
    {
        return $this->status->get($key);
    }

    public function isValidStatus($key) : bool
    {
        if ($this->getByKey($key) !== '') {
            return true;
        }

        return false;
    }
}