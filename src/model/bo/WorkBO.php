<?php
namespace App\Model\BO;

use App\Model\Bean\Work;
use App\Model\DAO\WorkDAO;
use App\Utils\Util;

class WorkBO
{
    private $workDao;

    public function __construct($database)
    {
        $this->workDao = new WorkDAO($database);
    }

    public function hasWork(int $workId) : bool
    {
        return $this->workDao->has($workId);
    }

    public function getWork(int $workId) : Work
    {
        $dataArray = $this->workDao->select($workId);

        $dataArray['start_date'] = Util::createDate(
            $dataArray['start_day'],
            $dataArray['start_month'],
            $dataArray['start_year']
        );
        $dataArray['end_date'] = Util::createDate(
            $dataArray['end_day'],
            $dataArray['end_month'],
            $dataArray['end_year']
        );

        return (new Work($dataArray))->toArray();
    }

    public function getWorks() : array
    {
        $rawData = $this->workDao->selectAll();
        return $this->transformRawDataToRealData($rawData);
    }

    public function getWorksHasWeekOfYear($week, $year) : array
    {
        $rawData = $this->workDao->selectWorkHasWeekOfYear($week, $year);

        return $this->transformRawDataToRealData($rawData);
    }

    public function getWorksHasMonthOfYear($month, $year) : array
    {
        $rawData = $this->workDao->selectWorkHasMonthOfYear($month, $year);

        return $this->transformRawDataToRealData($rawData);
    }

    public function getWorksToday($today) : array
    {
        $today = Util::extractDatetime($today);
        $rawData = $this->workDao->selectWorkToday($today['day'], $today['month'], $today['year']);

        return $this->transformRawDataToRealData($rawData);
    }

    public function transformRawDataToRealData(array $rawData) : array
    {
        $works = [];

        foreach ($rawData as $key => $dataArray) {
            $dataArray['start_date']  = Util::createDate(
                                            $dataArray['start_day'],
                                            $dataArray['start_month'],
                                            $dataArray['start_year']
                                        );
            $dataArray['end_date']    = Util::createDate(
                                            $dataArray['end_day'],
                                            $dataArray['end_month'],
                                            $dataArray['end_year']
                                        );
            array_push($works, (new Work($dataArray))->toArray());
        }

        return $works;
    }

    public function createWork(array $dataWork) : int
    {
        $statusBo = new StatusBO();
        $startDate = Util::extractDatetime($dataWork['startDate']);
        $endDate = Util::extractDatetime($dataWork['endDate']);

        $work = new Work();

        $work->workName     = $dataWork['workName'];
        $work->startDay     = $startDate['day'];
        $work->startWeek    = $startDate['week'];
        $work->startMonth   = $startDate['month'];
        $work->startYear    = $startDate['year'];
        $work->endDay       = $endDate['day'];
        $work->endWeek      = $endDate['week'];
        $work->endMonth     = $endDate['month'];
        $work->endYear      = $endDate['year'];
        $work->status       = 1;

        return $this->workDao->create($work);
    }

    public function updateWork(array $dataWork) : bool
    {
        $statusBo = new StatusBO();
        $startDate = Util::extractDatetime($dataWork['startDate']);
        $endDate = Util::extractDatetime($dataWork['endDate']);

        if ($statusBo->isValidStatus($dataWork['status'])) {
            $work = new Work();
            $work->workId       = $dataWork['workId'];
            $work->workName     = $dataWork['workName'];
            $work->startDay     = $startDate['day'];
            $work->startWeek    = $startDate['week'];
            $work->startMonth   = $startDate['month'];
            $work->startYear    = $startDate['year'];
            $work->endDay       = $endDate['day'];
            $work->endWeek      = $endDate['week'];
            $work->endMonth     = $endDate['month'];
            $work->endYear      = $endDate['year'];
            $work->status       = $dataWork['status'];

            return $this->workDao->update($work) === 1;
        }

        return false;
    }

    public function updateStatus(array $dataWork) : bool
    {
        $statusBo = new StatusBO();

        if ($statusBo->isValidStatus($dataWork['status'])) {
            $work = new Work();
            $work->workId = (int) $dataWork['workId'];
            $work->status = (int) $dataWork['status'];

            return $this->workDao->updateOnlyStatus($work) === 1;
        }

        return false;
    }

    public function deleteWork(int $workId) : bool
    {
        return $this->workDao->delete($workId) === 1;
    }
}