<?php
namespace App\Model\Bean;

class Status
{
    private $data = [
        1 => 'Planning',
        2 => 'Doing',
        3 => 'Complete'
    ];

    public function getAll() : array
    {
        return $this->data;
    }

    public function get($key) : string
    {
        return isset($this->data[$key]) ? $this->data[$key] : '';
    }
}