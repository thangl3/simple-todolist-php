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
        $sql = 'SELECT work_id, work_name, start_day, start_month, start_year, end_day, end_month, end_year, status, created_at
                FROM work
                WHERE work_id = :workId';

        return $this->mapper->fetchRow(
            $sql,
            [
                'workId' => $workId
            ]
        );
    }

    public function selectAll() : array
    {
        $sql = 'SELECT work_id, work_name, start_day, start_month, start_year, end_day, end_month,
                    end_year, status, created_at
                FROM work ORDER BY work_id DESC';

        return $this->mapper->fetchRows(
            $sql
        );
    }

    public function create(Work $work) : int
    {
         $sql = 'INSERT INTO work
            (work_name, start_day, start_month, start_year, end_day, end_month, end_year, status)
            VALUES
            (:workName, :startDay, :startMonth, :startYear, :endDay, :endMonth, :endYear, :status)';

        return $this->mapper->insert(
            $sql,
            [
                'workName'  => $work->workName,
                'startDay' => $work->startDay,
                'startMonth' => $work->startMonth,
                'startYear' => $work->startYear,
                'endDay'   => $work->endDay,
                'endMonth' => $work->endMonth,
                'endYear' => $work->endYear,
                'status'    => $work->status,
            ]
        );
    }

    public function update(Work $work) : int
    {
        $sql = 'UPDATE work
            SET work_name   = :workName,
                start_day   = :startDay,
                start_month = :startMonth,
                start_year  = :startYear,
                end_day     = :endDay,
                end_month   = :endMonth,
                end_year    = :endYear,
                status      = :status
            WHERE work_id   = :workId';

        return $this->mapper->update(
            $sql,
            [
                'workId'    => $work->workId,
                'workName'  => $work->workName,
                'startDay' => $work->startDay,
                'startMonth' => $work->startMonth,
                'startYear' => $work->startYear,
                'endDay'   => $work->endDay,
                'endMonth' => $work->endMonth,
                'endYear' => $work->endYear,
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