<?php
namespace heritage;
use Bd\BaseDonne;
require_once "../autloading/Autloading.php";
class Pagination {
    private int $page;
    private ?PDO $con;
    public function affichagePersonne(){
        $con = BaseDonne::database();
        $page = isset($_GET['page']) && intval($_GET['page']) ? $_GET['page'] : 1;
        $page2 = ($page - 1) * 5;

        $sql = $con->query("SELECT * FROM joueur limit 5 offset $page2");
         
        return $sql->fetchAll();
    }

    public function totalJoueur(){
        $con = BaseDonne::database();
        $sql = $con->query("SELECT count(*) FROM joueur");
    return $sql->fetchcolumn();

    }
    
}

