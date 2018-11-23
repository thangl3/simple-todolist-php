<?php

namespace App\Model\Bean;

class Work {
	private $workId;
    private $workName;
    private $startDate;
    private $endDate;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;

    public function __construct(array $data)
    {
        if (isset($data['workId']))
        {
            $this->workId = $data['workId'];
        }

        if (isset($data['workName']))
        {
            $this->workName = $data['workName'];
        }

        if (isset($data['startDate']))
        {
            $this->startDate = $data['startDate'];
        }

        if (isset($data['endDate']))
        {
            $this->endDate = $data['endDate'];
        }

        if (isset($data['status']))
        {
            $this->status = $data['status'];
        }

        if (isset($data['createdAt']))
        {
            $this->createdAt = $data['createdAt'];
        }

        if (isset($data['updatedAt']))
        {
            $this->updatedAt = $data['updatedAt'];
        }

        if (isset($data['deletedAt']))
        {
            $this->deletedAt = $data['deletedAt'];
        }
	}

    public function __get($name)
    {
		return $this->$name;
	}

    public function __set($name, $value)
    {
		$this->$name = $value;
	}
}