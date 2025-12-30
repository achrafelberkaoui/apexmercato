<?php

class BaseDonne {
    private $user;
    private $pass;
    private $db;
    private $host;
    private $pdo;
    
    public static function database($host,$db,$user,$pass){
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (PDOException $e) {
            die("connexion failed : " . $e->getMessage());
        }
    }
};

$con = BaseDonne::database(host:"localhost",db:"apexmercato",user:"root",pass:"");