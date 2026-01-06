<?php
namespace ClassFinal;
use Bd\BaseDonne;
use PDO;
$con = BaseDonne::database();
use Exception;


final class TransferService{
    private PDO $con;
    private FinancialEngine $engine;
    public function __construct(PDO $con, FinancialEngine $engine){
        $this->con = $con;
        $this->engine = $engine;
    }

    public function transfPlyer(int $playerId, int $eq1, int $eq2): bool{
    try{
       $this->con->beginTransaction();
       $stmt = $this->con->prepare("SELECT id,budget FROM equipe where id IN (?,?)");
       $stmt->execute([$eq1, $eq2]);
       $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
       $stm = $this->con->prepare("SELECT valeur_marches FROM joueur where id = ?");
       $stm->execute([$playerId]);
       $price = $stm->fetchColumn();

       $budgetEq1 = null;
       $budgetEq1 = null;
        foreach($res as $re){
        if($re['id']==$eq1)
            $budgetEq1 = $re['budget'];

        if($re['id']==$eq2)
            $budgetEq2 = $re['budget'];
        }

       if(!$this->engine->canAfford($price, $budgetEq2)){
        throw new Exception("L'équipe acheteuse n'a pas assez de budget");
       }
       //ajout budget eq 1
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget + ? WHERE id = ?");
       $stmt->execute([$price, $budgetEq1]);
       //--budget eq 2
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget - ? WHERE id = ?");
       $stmt->execute([$price, $budgetEq2]);
       //cahnge joueur equipe
       $stmt = $this->con->prepare("UPDATE joueur set equipe_id = ? WHERE id = ?");
       $stmt->execute([$eq2, $playerId]);

        $this->con->commit();
        return true;
    }catch(Exception $e){

            $this->con->rollback();
            error_log("Transfer failed : " . $e->getMessage());

            return false;
    }
    }
    

}