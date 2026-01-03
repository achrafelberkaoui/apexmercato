<?php
require_once "../bd/baseDonne.php";
require_once "../trait/CRUD.php";
class Equipe {
    use CRUD;

    public function __construct(PDO $con){
        $this->conne($con, "equipe");
    }

    public function checkId(int $id): bool {
        $stmt = $this->con->prepare("SELECT COUNT(*) FROM equipe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getById(int $id): array|false {
        $stmt = $this->con->prepare("SELECT * FROM equipe WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function modifBudget(int $id, float $budget): bool {
        $stmt = $this->con->prepare("UPDATE equipe SET budget = ? WHERE id = ?");
        return $stmt->execute([$budget, $id]);
    }
}