<?php
    session_start();  
    $server="localhost";
    $pass="";
    $login="root";
    $dbname="gestion";
    try{
        $connexion=new PDO("mysql:host=$server;dbname=$dbname",$login,$pass);
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connexion failed";
    }
?>