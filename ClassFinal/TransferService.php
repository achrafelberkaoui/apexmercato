<?php
namespace ClassFinal;
require_once "../autloading/Autloading.php";
use Bd\BaseDonne;
use Heritage\Player;
use Heritage\Coach;
use ClassFinal\FinancialEngine;
use ReadonlyContrat\Contract;
use PDO;
use Exception;

final class TransferService{
    private PDO $con;
    public function __construct(PDO $con){
        $this->con = $con;
    }

    public function transfPersonne(int $playerId,int $coachId, int $eq1, int $eq2, string $type): bool{
    try{
       $this->con->beginTransaction();
       $stmt = $this->con->prepare("SELECT id,budget FROM equipe where id IN (?,?)");
       $stmt->execute([$eq1, $eq2]);
       $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($type === "player"){
       $stm = $this->con->prepare("SELECT Salaire FROM contrat where joueur_id= ?");
       $stm->execute([$playerId]);
        }else{
        $stm = $this->con->prepare("SELECT Salaire FROM contrat where coach_id= ?");
       $stm->execute([$coachId]);
        }
        $price = $stm->fetchColumn();
       $budgetEq1 = null;
       $budgetEq2 = null;
        foreach($res as $re){
        if($re['id']==$eq1)
            $budgetEq1 = $re['budget'];

        if($re['id']==$eq2)
            $budgetEq2 = $re['budget'];

        }

        $engine = new FinancialEngine();

       if(!$engine->canAfford($price, $budgetEq2)){
        throw new Exception("L'équipe acheteuse n'a pas assez de budget");
       }
       //ajout budget eq 1
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget + ? WHERE id = ?");
         $stmt->execute([$price, $eq1]);


       //--budget eq 2
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget - ? WHERE id = ?");
        $stmt->execute([$price, $eq2]);
               

       //change joueur equipe
    //    $stmt = $this->con->prepare("UPDATE joueur set equipe_id = ? WHERE id = ?");
    //    $stmt->execute([$eq2, $playerId]);

        if($type === "player"){
        //change date contrat
        $changeCont = $this->con->prepare("UPDATE contrat set Date_fin = ? WHERE joueur_id = ?");
        $changeCont->execute([date("y-m-d"), $playerId]);
        //change equipe player
        $changeEquipe = $this->con->prepare("UPDATE joueur set equipe_id = ? WHERE id = ?");
        $changeEquipe->execute([$eq2, $playerId]);
            }else{
        //change date contrat
        $changeCont = $this->con->prepare("UPDATE contrat set Date_fin = ? WHERE id = ?");
        $changeCont->execute([date("y-m-d"), $coachId]);
        //change equipe player
        $changeEquipe = $this->con->prepare("UPDATE coach set equipe_id = ? WHERE coach_id = ?");
        $changeEquipe->execute([$eq2, $coachId]);
        }
       
       //fin contrat

       //cree contrat
        $this->con->commit();
        return true;
    }catch(Exception $e){

            $this->con->rollback();
            error_log("Transfer failed : " . $e->getMessage());

            return false;
    }
    }
    

}
