<?php
namespace Heritage;
use Bd\BaseDonne;
use Trait\Crud;
use PDO;
require_once "../autloading/Autloading.php";
class Equipe {
    use Crud;

    public function __construct(PDO $con){
        $this->conne($con, "equipe");
    }

    public function checkId(int $id): bool {
        $stmt = $this->con->prepare("SELECT COUNT(*) FROM equipe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }


    public function modifBudget(int $id, float $budget): bool {
        $stmt = $this->con->prepare("UPDATE equipe SET budget = ? WHERE id = ?");
        return $stmt->execute([$budget, $id]);
    }
}