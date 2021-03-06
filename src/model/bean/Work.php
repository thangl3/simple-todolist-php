<?php
namespace App\Model\Bean;

class Work
{
	private $workId;
    private $workName;
    private $startDay;
    private $startWeek;
    private $startMonth;
    private $startYear;
    private $startTime;
    private $endDay;
    private $endWeek;
    private $endMonth;
    private $endYear;
    private $endTime;
    private $status;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $startDate;
    private $endDate;

    /**
     * Receive an array and parse it to each data for each property.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        if (isset($data['work_id'])) {
            $this->workId = $data['work_id'];
        }

        if (isset($data['work_name'])) {
            $this->workName = $data['work_name'];
        }

        if (isset($data['start_day'])) {
            $this->startDay = $data['start_day'];
        }

        if (isset($data['start_week'])) {
            $this->startWeek = $data['start_week'];
        }

        if (isset($data['start_month'])) {
            $this->startMonth = $data['start_month'];
        }

        if (isset($data['start_year'])) {
            $this->startYear = $data['start_year'];
        }

        if (isset($data['start_time'])) {
            $this->startTime = $data['start_time'];
        }

        if (isset($data['end_day'])) {
            $this->endDay = $data['end_day'];
        }

        if (isset($data['end_week'])) {
            $this->endWeek = $data['end_week'];
        }

        if (isset($data['end_month'])) {
            $this->endMonth = $data['end_month'];
        }

        if (isset($data['end_year'])) {
            $this->endYear = $data['end_year'];
        }

        if (isset($data['end_time'])) {
            $this->endTime = $data['end_time'];
        }

        if (isset($data['start_date'])) {
            $this->startDate = $data['start_date'];
        }

        if (isset($data['end_date'])) {
            $this->endDate = $data['end_date'];
        }

        if (isset($data['status'])) {
            $this->status = $data['status'];
        }

        if (isset($data['created_at'])) {
            $this->createdAt = $data['created_at'];
        }

        if (isset($data['updated_at'])) {
            $this->updatedAt = $data['updated_at'];
        }

        if (isset($data['deleted_at'])) {
            $this->deletedAt = $data['deleted_at'];
        }
    }
    
    public function toArray()
    {
        return [
            'workId' => $this->workId,
            'workName' => $this->workName,
            'startDate' => $this->startDate,
            'startWeek' => $this->startWeek,
            'startTime' => $this->startTime,
            'endDate' => $this->endDate,
            'endWeek' => $this->endWeek,
            'endTime' => $this->endTime,
            'status' => $this->status,
            'created' => $this->createdAt
        ];
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