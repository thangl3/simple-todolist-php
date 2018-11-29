<?php
namespace App\Model\DAO;

use App\Model\Bean\Work;

class WorkDAO
{
    /**
     * Using mapper of PDO Object
     *
     * @var Mapper
     */
    private $mapper;

    public function __construct($database)
    {
        $this->mapper = new Mapper($database);
    }

    public function has(int $workId) : bool
    {
        $sql = 'SELECT work_id FROM work WHERE work_id = :workId';

        return $this->mapper->has(
            $sql,
            [
                'workId' => $workId
            ]
        );
    }

    public function select(int $workId) : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_week, start_month, start_year, start_time,
        end_day, end_week, end_month, end_year, end_time, status, created_at
                FROM work
                WHERE work_id = :workId';

        return $this->mapper->fetchRow(
            $sql,
            [
                'workId' => $workId
            ]
        );
    }

    public function selectWorkHasWeekOfYear($week, $year) : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_week, start_month, start_year, start_time,
        end_day, end_week, end_month, end_year, end_time, status, created_at
                FROM work
                WHERE
                    start_year = :year AND start_week <= :week AND end_week >= :week
                    OR
                    end_year = :year AND start_week <= :week AND end_week < 2
                    OR
                    start_year < :year AND end_year > :year
                    OR
                    end_year = :year AND start_year < :year AND end_week >= :week';

        return $this->mapper->fetchRows(
            $sql,
            [
                'year' => $year,
                'week' => $week
            ]
        );
    }

    public function selectWorkHasMonthOfYear($month, $year) : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_week, start_month, start_year, start_time,
        end_day, end_week, end_month, end_year, end_time, status, created_at
                FROM work
                WHERE
                    (start_year = :year AND start_month <= :month AND end_month >= :month)
                    OR
                    start_year < :year AND end_year > :year
                    OR
                    end_year = :year AND start_year < :year AND end_month >= :month';

        return $this->mapper->fetchRows(
            $sql,
            [
                'month' => $month,
                'year' => $year
            ]
        );
    }

    public function selectWorkToday($day, $month, $year) : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_week, start_month, start_year, start_time,
        end_day, end_week, end_month, end_year, end_time, status, created_at
                FROM work
                WHERE
                    start_day <= :day  AND end_day >= :day
                    AND
                    start_month <= :month AND end_month >= :month
                    AND
                    start_year <= :year AND end_year >= :year';

        return $this->mapper->fetchRows(
            $sql,
            [
                'day' => $day,
                'month' => $month,
                'year' => $year
            ]
        );
    }

    public function selectAll() : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_week, start_month, start_year, start_time,
                        end_day, end_week, end_month, end_year, end_time, status, created_at
                FROM work ORDER BY work_id DESC';

        return $this->mapper->fetchRows(
            $sql
        );
    }

    public function create(Work $work) : int
    {
         $sql = 'INSERT INTO work
            (work_name, start_day, start_week, start_month, start_year, start_time, end_day, end_week,
                end_month, end_year, end_time, status)
            VALUES
            (:workName, :startDay, :startWeek, :startMonth, :startYear, :startTime, :endDay, :endWeek,
                :endMonth, :endYear, :endTime, :status)';

        return $this->mapper->insert(
            $sql,
            [
                'workName'  => $work->workName,
                'startDay' => $work->startDay,
                'startWeek' =>$work->startWeek,
                'startMonth' => $work->startMonth,
                'startYear' => $work->startYear,
                'startTime' =>$work->startTime,
                'endDay'   => $work->endDay,
                'endWeek' =>$work->endWeek,
                'endMonth' => $work->endMonth,
                'endYear' => $work->endYear,
                'endTime' =>$work->endTime,
                'status'    => $work->status,
            ]
        );
    }

    public function update(Work $work) : int
    {
        $sql = 'UPDATE work
            SET work_name   = :workName,
                start_day   = :startDay,
                start_week  = :startWeek,
                start_month = :startMonth,
                start_year  = :startYear,
                start_time  = :startTime,
                end_day     = :endDay,
                end_week    = :endWeek,
                end_month   = :endMonth,
                end_year    = :endYear,
                end_time    = :endTime,
                status      = :status
            WHERE work_id   = :workId';

        return $this->mapper->update(
            $sql,
            [
                'workId'    => $work->workId,
                'workName'  => $work->workName,
                'startDay' => $work->startDay,
                'startWeek' =>$work->startWeek,
                'startMonth' => $work->startMonth,
                'startYear' => $work->startYear,
                'startTime' =>$work->startTime,
                'endDay'   => $work->endDay,
                'endWeek' =>$work->endWeek,
                'endMonth' => $work->endMonth,
                'endYear' => $work->endYear,
                'endTime' =>$work->endTime,
                'status'    => $work->status,
            ]
        );
    }

    public function updateOnlyStatus(Work $work) : int
    {
        $sql = 'UPDATE work
                SET status      = :status
                WHERE work_id   = :workId';

        return $this->mapper->update(
            $sql,
            [
                'workId'    => $work->workId,
                'status'    => $work->status,
            ]
        );
    }

    public function delete(int $workId) : int
    {
        $sql = 'DELETE FROM work
            WHERE work_id   = :workId';

        return $this->mapper->delete(
            $sql,
            [
                'workId' => $workId
            ]
        );
    }
}