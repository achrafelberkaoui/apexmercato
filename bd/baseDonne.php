<?php
namespace Bd;
use \PDO;

class BaseDonne {
    private static string $user = "root";
    private static string $pass = "";
    private static string $db = "apexmercato";
    private static string $host = "localhost";
    private static ?PDO $pdo=null;
    
    public static function database(): PDO{
        if(self::$pdo === null){
        try {
            self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$user,self::$pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("connexion failed : " . $e->getMessage());
        }
        }
        return self::$pdo;
    }
};
$con = BaseDonne::database();