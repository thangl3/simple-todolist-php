<?php
namespace App\Model\Bean;

class Work
{
	private $workId;
    private $workName;
    private $startDate;
    private $endDate;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;

    /**
     * Receive an array and parse it to each data for each property.
     * Support camelCase and snake_case
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (isset($data['work_id'])                 || isset($data['workId'])) {
            $this->workId = $data['work_id']        ?? $data['workId'];
        }

        if (isset($data['work_name'])               || isset($data['workName'])) {
            $this->workName = $data['work_name']    ?? $data['workName'];
        }

        if (isset($data['start_date'])              || isset($data['startDate'])) {
            $this->startDate = $data['start_date']  ?? $data['startDate'];
        }

        if (isset($data['end_date'])                || isset($data['endDate'])) {
            $this->endDate = $data['end_date']      ?? $data['endDate'];
        }

        if (isset($data['status'])) {
            $this->status = $data['status'];
        }

        if (isset($data['created_at'])              || isset($data['createdAt'])) {
            $this->createdAt = $data['created_at']  ?? $data['createdAt'];
        }

        if (isset($data['updated_at'])              || isset($data['updatedAt'])) {
            $this->updatedAt = $data['updated_at']  ?? $data['updatedAt'];
        }

        if (isset($data['deleted_at'])              || isset($data['deletedAt'])) {
            $this->deletedAt = $data['deleted_at']  ?? $data['deletedAt'];
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