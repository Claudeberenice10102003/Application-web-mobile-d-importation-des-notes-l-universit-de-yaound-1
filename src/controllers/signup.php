<?php

namespace Application\Controllers\Signup;

use Application\Lib\Database\DatabaseConnection;

use Application\Model\Student\Student;
// use Application\Model\Department\Department;
// use Application\Model\Level\Level;
// use Application\Model\Sector\Sector;

use Application\Model\Student\StudentRepository;
use Application\Model\Sector\SectorRepository;
use Application\Model\Department\DepartmentRepository;
use Application\Model\Level\LevelRepository;

require_once('src/lib/database.php');
require_once('src/model/student.php');
require_once('src/model/level.php');
require_once('src/model/sector.php');
require_once('src/model/department.php');



class Signup
{
    public function execute($student_post)
    {   
        if (isset($student_post)) {
            $studentRepository = new StudentRepository();
            $studentRepository->connection = new DatabaseConnection();

            $student = new Student();
            $student->first_name = $student_post['first_name'];
            $student->last_name = $student_post['last_name'];
            $student->date_of_birth = $student_post['date_of_birth'];
            $student->gender = $student_post['gender'];
            $student->matricule = $student_post['matricule'];
            $student->id_department = $student_post['id_department'];
            $student->id_level = $student_post['id_level'];
            $student->id_sector = $student_post['id_sector'];

            $studentRepository->store($student);
            
            header("Location: templates/login.php?message=Creation du compte Reussit&type=success");
            exit;
            
        } else {
            header("Location: templates/signup.php?message=Tous les champs sont obligatoires");
            exit;
        }
    }

    public function page()
    {
        $levelRepository = new LevelRepository();
        $levelRepository->connection = new DatabaseConnection();
        $levels = $levelRepository->all();

        $sectorRepository = new SectorRepository();
        $sectorRepository->connection = new DatabaseConnection();
        $sectors = $sectorRepository->all();

        $departmentRepository = new DepartmentRepository();
        $departmentRepository->connection = new DatabaseConnection();
        $departments = $departmentRepository->all();

        require_once("templates/signup.php");
    }
}
