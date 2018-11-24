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
        $sql = 'SELECT COUNT(1) FROM work WHERE work_id = :workId';

        return $this->mapper->has(
            $sql,
            [
                'workId' => $workId
            ]
        );
    }

    public function select(int $workId) : array
    {
        $sql = 'SELECT work_id, work_name, start_date, end_date, status, created_at
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
        $sql = 'SELECT work_id, work_name, start_date, end_date, status, created_at
                FROM work';

        return $this->mapper->fetchRows(
            $sql
        );
    }

    public function create(Work $work) : int
    {
         $sql = 'INSERT INTO work
            (work_name, start_date, end_date)
            VALUES
            (:workName, :startDate, :endDate)';

        return $this->mapper->insert(
            $sql,
            [
                'workName'  => $work->workName,
                'startDate' => $work->startDate,
                'endDate'   => $work->endDate
            ]
        );
    }

    public function update(Work $work) : int
    {
        $sql = 'UPDATE work
            SET work_name   = :workName,
                start_date  = :startDate,
                end_date    = :endDate,
                status      = :status
            WHERE work_id   = :workId';

        return $this->mapper->update(
            $sql,
            [
                'workId'    => $work->workId,
                'workName'  => $work->workName,
                'startDate' => $work->startDate,
                'endDate'   => $work->endDate,
                'status'    => $work->status,
            ]
        );
    }

    public function updateStatus(Work $work) : int
    {
        $sql = 'UPDATE work
                status      = :status
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
