<?php
namespace ClassFinal;
require_once "../autloading/Autloading.php";
use Bd\BaseDonne;
use ClassFinal\FinancialEngine;
use PDO;
$con = BaseDonne::database();
use Exception;


final class TransferService{
    private PDO $con;
    public function __construct(PDO $con){
        $this->con = $con;
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
       $budgetEq2 = null;
        foreach($res as $re){
        if($re['id']==$eq1)
            $budgetEq1 = $re['budget'];
        var_dump($budgetEq1);
        var_dump("aaaaaa");

        if($re['id']==$eq2)
            $budgetEq2 = $re['budget'];
        var_dump($budgetEq2);
        var_dump("b");
        }

        $engine = new FinancialEngine();

       if(!$engine->canAfford($price, $budgetEq2)){
        throw new Exception("L'équipe acheteuse n'a pas assez de budget");
       }
       var_dump($budgetEq1);
       var_dump("p");
       var_dump($budgetEq2);
       var_dump("cc");
       var_dump($price);
       //ajout budget eq 1
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget + ? WHERE id = ?");
       $stmt->execute([$price, $eq1]);
       //--budget eq 2
       $stmt = $this->con->prepare("UPDATE equipe set budget = budget - ? WHERE id = ?");
       $stmt->execute([$price, $eq2]);
       //change joueur equipe
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