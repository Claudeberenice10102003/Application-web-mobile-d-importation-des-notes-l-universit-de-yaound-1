<?php
namespace Application\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            
            $servername = "localhost";
            $username = "admin";
            $password = "mdp";
            $dbname = "ict";

            $this->database = new \PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        }

        return $this->database;
    }
}
