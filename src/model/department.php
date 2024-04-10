<?php

namespace Application\Model\Department;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;


class Department {
    public $id;
    public $name;
}

class DepartmentRepository{
    public DatabaseConnection $connection;

    public function all() {

        $query = "SELECT * FROM departments";
        
        $statement = $this->connection->getConnection()->query($query);

        $departements = [];

        while (($row = $statement->fetch())) {
            $departement = new Department();
            $departement->id = $row["id"];
            $departement->name = $row["name"];
    
            $departements[] = $departement;
        }

        return $departements;
    }
}