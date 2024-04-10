<?php

namespace Application\Model\Student;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Student {
    public $id;
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $matricule;
     public $gender;
    public $id_sector;
    public $id_level;
    public $id_department;
}

class StudentRepository {
    public DatabaseConnection $connection;

    public function store(Student $student) {

        $query = "INSERT INTO students (first_name, last_name, date_of_birth, matricule, gender, id_sector, id_level, id_department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $statement = $this->connection->getConnection()->prepare($query);

        $statement->execute([
            $student->first_name,
            $student->last_name,
            $student->date_of_birth,
            $student->matricule,
            $student->gender,
            $student->id_sector,
            $student->id_level,
            $student->id_department
        ]);

        $row = $statement->fetch();
        $student = new Student();
        $student->id = $row['id'];
        $student->first_name = $row['first_name'];
        $student->last_name = $row['last_name'];
        $student->date_of_birth = $row['date_of_birth'];
        $student->matricule = $row['matricule'];
        $student->gender = $row['gender'];
        $student->id_sector = $row['id_sector'];
        $student->id_level = $row['id_level'];
        $student->id_department = $row['id_department'];
        return $student;

    }

    public function all() {

        $query = "SELECT * FROM students";
        
        $statement = $this->connection->getConnection()->query($query);

        $students = [];

        while (($row = $statement->fetch())) {
            $student = new Student();
            $student->id = $row['id'];
            $student->first_name = $row['first_name'];
            $student->last_name = $row['last_name'];
            $student->date_of_birth = $row['date_of_birth'];
            $student->matricule = $row['matricule'];
            $student->gender = $row['gender'];
            $student->id_sector = $row['id_sector'];
            $student->id_level = $row['id_level'];
            $student->id_department = $row['id_department'];

            $students[] = $student;
        }

        return $students;
    }

    public function find($matricule) {
        
        $query = "SELECT * FROM students WHERE matricule = ?";
        $statement = $this->connection->getConnection()->prepare($query);
        $statement->execute([$matricule]);

        $row = $statement->fetch();
        if (!$row) {
            return null;
        }
        $student = new Student();
        $student->id = $row['id'];
        $student->first_name = $row['first_name'];
        $student->last_name = $row['last_name'];
        $student->date_of_birth = $row['date_of_birth'];
        $student->matricule = $row['matricule'];
        $student->gender = $row['gender'];
        $student->id_sector = $row['id_sector'];
        $student->id_level = $row['id_level'];
        $student->id_department = $row['id_department'];

        return $student;
       
    }
}
