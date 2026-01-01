<?php
require_once "../abstract/abstraitPersonne.php";
require_once "../bd/baseDonne.php";
require_once "../trait/CRUD.php";
class Player extends Personne{
        private string $Role;
        private float $ValeurMarch;
        public function __construct($nom, $email, $nationalite, $Role, $ValMa){
        parent::__construct($nom, $email, $nationalite);
        $this->Role = $Role;
        $this->ValeurMarch = $ValMa;
    }
     use CRUD;
    public function getAnnualCost(){
       return ($this->ValeurMarch * 0.12);
    }

}