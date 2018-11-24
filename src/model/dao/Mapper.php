<?php
namespace App\Model\DAO;

/**
 * The class has mission is mapping with PDO Object
 */
class Mapper
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Check whether row has exist or not with where
     *
     * @param string $sql
     * @param array $data
     * @return boolean
     */
    public function has($sql, array $data = []) : bool
    {
        $stmt = $this->db->prepare($sql);

        if (count($data) > 0)
            $stmt->execute($data);
        else
            $stmt->execute();

        $result = $stmt->fetch();

        if ($result != null) {
            return true;
        }

        return false;
    }

    /**
     * Fetch only one row with where
     * Where recieved an array data
     *
     * @param string $sql
     * @param array $data
     * @return void
     */
    public function fetchRow(string $sql, array $data = [])
    {
        $stmt = $this->db->prepare($sql);

        if (count($data) > 0)
            $stmt->execute($data);
        else
            $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Fetch all raw data from database with where
     * Where recieved an array data
     *
     * @param string $sql
     * @param array $data
     * @return array
     */
    public function fetchRows(string $sql, array $data = []) : array
    {
        $stmt = $this->db->prepare($sql);

        if (count($data) > 0)
            $stmt->execute($data);
        else
            $stmt->execute();

        $results = [];

        while($row = $stmt->fetch()) {
            $results[] = $row;
        }

        return $results;
    }

    public function insert(string $sql, array $data) : int
    {
        $this->run($sql, $data);
        return $this->db->lastInsertId();
    }

    public function update(string $sql, array $data = [])
    {
        return $this->run($sql, $data);
    }

    public function delete(string $sql, array $data = [])
    {
        return $this->run($sql, $data);
    }

    /**
     * Common method with mission is run raw sql query and data of statement, and excute them
     *
     * @param string $sql
     * @param array $data
     * @return integer
     */
    private function run(string $sql, array $data)
    {
        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute($data);

        if(!$result) {
            return -1;
            // throw new Exception("Have problem when running SQL");
        }

        return $result;
    }
}