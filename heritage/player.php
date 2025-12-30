<?php
require_once "./abstract/abstraitPersonne.php";
class Player extends Personne{
        private string $Role;
        private string $Pseudo;
        private float $ValeurMarch;
        public function __construct($nom, $email, $nationalite, $salaire, $Role, $Pseudo, $ValMa){
        parent::__construct($nom, $email, $nationalite, $salaire);
        $this->Role = $Role;
        $this->Pseudo = $Pseudo;
        $this->ValeurMarch = $ValMa;
    }
    public function getAnnualCost(){
       return ($this->salaire * 0.12);
    }

}