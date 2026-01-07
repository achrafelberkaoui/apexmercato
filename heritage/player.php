<?php
namespace Heritage;
use Abstract\Personne;
use Bd\BaseDonne;
use Trait\Crud;
use PDO;
require_once "../autloading/Autloading.php";

class Player extends Personne{
        private ?string $Role;
        private ?float $ValeurMarch;
     use Crud;
    public function __construct(PDO $pdo, $nom, $email, $nationalite, $role, $valeur, $id_equipe)
    {
        $this->conne($pdo, "joueur");
        parent::__construct($nom, $email, $nationalite, $id_equipe);
        $this->Role = $role;
        $this->ValeurMarch = $valeur;
    }
    public function equipeExists(int $id): bool
    {
    $sql = "SELECT COUNT(*) FROM equipe WHERE id = ?";
    $stmt = $this->con->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetchColumn() > 0;
    }

    public function getAnnualCost(){
       return ($this->ValeurMarch * 0.12);
    }

}