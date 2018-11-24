<?php
namespace App\Model\BO;

use App\Model\Bean\Work;
use App\Model\DAO\WorkDAO;

class WorkBO
{
    private $workDao;

    public function __construct($database)
    {
        $this->workDao = new WorkDAO($database);
    }

    /**
     * Fetch one work by id
     *
     * @param integer $workId
     * @return Work
     */
    public function selectById(int $workId) : Work
    {
        $dataArray = $this->workDao->select($workId);
        
        return new Work($dataArray);
    }

    /**
     * Fetch all of work in database to 1 array
     *
     * @return array
     */
    public function selectAll() : array
    {
        $rawData = $this->workDao->selectAll();
        $works = [];

        foreach ($rawData as $key => $dataArray) {
            array_push($works, new Work($dataArray));
        }

        return $works;
    }

    /**
     * Create a work with data from user
     * Return the id was inserted
     *
     * @param array $dataWork
     * @return integer
     */
    public function create(array $dataWork) : int
    {
        return $this->workDao->create(new Work($dataWork));
    }

    /**
     * Update a work and return true if sucess or false
     *
     * @param array $dataWork
     * @return boolean
     */
    public function update(array $dataWork) : bool
    {
        return $this->workDao->update(new Work($dataWork)) === 1;
    }

    /**
     * Delete a work and return true if sucess or false
     *
     * @param integer $workId
     * @return boolean
     */
    public function delete(int $workId) : bool
    {
        return $this->workDao->delete($workId) === 1;
    }
}