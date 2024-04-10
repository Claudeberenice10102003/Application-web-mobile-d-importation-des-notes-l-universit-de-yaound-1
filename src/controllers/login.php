<?php

namespace Application\Controllers\Login;

use Application\Model\Student\StudentRepository;
use Application\Lib\Database\DatabaseConnection;


require_once('src/lib/database.php');
require_once('src/model/student.php');


class Login
{
    public function execute(string $matricule)
    {   
        if (isset($matricule)) {
            $studentRepository = new StudentRepository();
            $studentRepository->connection = new DatabaseConnection();
            $student = $studentRepository->find($matricule);
            if (isset($student)) {
                require_once('templates/home.php');
                exit;
            }else{
                header("Location: templates/login.php?message=Le matricule n'existe pas !");
                exit;
            }
        } else {
            header("Location: templates/login.php?message=Le matricule est   champ obligatoire");
            exit;
        }
    }
}
