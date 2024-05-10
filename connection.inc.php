<?php
    session_start();  
    $server="localhost";
    $pass="berenice";
    $login="root";
    $dbname="soutenance";
    try{
        $connexion=new PDO("mysql:host=$server;port=3307;dbname=$dbname",$login,$pass);
        $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connexion failed";
    }
?>