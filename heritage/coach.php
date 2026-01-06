<?php
namespace Heritage;
use Abstract\Personne;
use Bd\BaseDonne;
use PDO;
use Trait\Crud;
require_once "../autloading/Autloading.php";

class Coach extends Personne{
        private string $styl;
        private $annExp;
        use Crud;
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