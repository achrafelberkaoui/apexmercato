<?php
namespace ReadonlyContrat;
use Bd\BaseDonne;
use PDO;
use Trait\Crud;


class Contract {
    use Crud;

    public readonly ?int $joueur_id;
    public readonly ?int $coach_id;
    public readonly ?int $equipe_id;
    public readonly string $date_contrat;
    public readonly ?string $date_fin;
    public readonly float $salaire;


    public function __construct(PDO $con, ?int $joueur_id, ?int $equipe_id, ?int $coach_id, string $date_contrat, ?string $date_fin, float $salaire){
        $this->joueur_id = $joueur_id;
        $this->coach_id = $coach_id;
        $this->equipe_id = $equipe_id;
        $this->date_contrat = $date_contrat;
        $this->date_fin = $date_fin;
        $this->salaire = $salaire;
        $this->conne($con, "contrat");
    }

    public function save(): bool {
        $data = [
            'joueur_id' => $this->joueur_id,
            'coach_id' => $this->coach_id,
            'equipe_id'=> $this->equipe_id,
            'date_contrat' => $this->date_contrat,
            'date_fin' => $this->date_fin,
            'Salaire' => $this->salaire
        ];
        return $this->creatNew($data);
    }

    public function allContracts(): array {
        $sql = "SELECT c.*, j.name AS joueur_name, co.name AS coach_name
                FROM contrat c
                LEFT JOIN joueur j ON c.joueur_id = j.id
                LEFT JOIN coach co ON c.coach_id = co.id
                LEFT JOIN equipe e ON c.equipe_id = e.id
                ORDER BY c.id DESC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
