<?php

namespace Application\Model\Sector;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Sector {
    public $id;
    public $name;

    public $id_department;
}

class SectorRepository{
    public DatabaseConnection $connection;

    public function all() {

        $query = "SELECT * FROM sectors";
        
        $statement = $this->connection->getConnection()->query($query);

        $sectors = [];

        while (($row = $statement->fetch())) {
            $sector = new Sector();
            $sector->id = $row["id"];
            $sector->name = $row["name"];
            $sector->id_department = $row["id_department"];
    
            $sectors[] = $sector;
        }

        return $sectors;
    }
}