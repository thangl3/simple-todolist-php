<?php
namespace App\Model\DAO;

/**
 * summary
 */
class Mapper {
    private $db;
    /**
     * summary
     */
    public function __construct($db) {
        $this->db = $db;
    }

    public function isExist($sql, array $data) {
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

    public function fetchRow($sql, array $data = []) {
        $stmt = $this->db->prepare($sql);

        if (count($data) > 0)
            $stmt->execute($data);
        else
            $stmt->execute();

        return $stmt->fetch();
    }

    public function fetchRows($sql, array $data = []) {
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

    public function insert($sql, array $data) {
        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute($data);

        if(!$result) {
            throw new Exception("Could not insert the record");
        }

        return $this->db->lastInsertId();
    }
}