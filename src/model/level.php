<?php

namespace Application\Model\Level;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Level {
    public $id;
    public $name;
}

class LevelRepository{
    public DatabaseConnection $connection;

    public function all() {

        $query = "SELECT * FROM levels";
        
        $statement = $this->connection->getConnection()->query($query);

        $levels = [];

        while (($row = $statement->fetch())) {
            $level = new Level();
            $level->id = $row["id"];
            $level->name = $row["name"];
    
            $levels[] = $level;
        }

        return $levels;
    }
}