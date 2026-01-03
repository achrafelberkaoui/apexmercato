<?php
require_once "../abstract/abstraitPersonne.php";
require_once "../bd/baseDonne.php";
require_once "../trait/CRUD.php";
class Coach extends Personne{
        private string $styl;
        private $annExp;
        use CRUD;
        public function __construct(PDO $con,$nom, $email, $nationalite, $styl, $annExp, $id_equipe){
        $this->conne($con, "coach");
        parent::__construct($nom, $email, $nationalite, $id_equipe);
        $this->styl = $styl;
        $this->annExp = $annExp;
    }
    public function equipeExists(int $id): bool
    {
    $sql = "SELECT COUNT(*) FROM equipe WHERE id = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchColumn() > 0;
    }
    public function getAnnualCost(){
       return ($this->annExp * 0.12);
    }

}