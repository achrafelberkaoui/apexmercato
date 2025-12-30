<?php
require_once "./abstract/abstraitPersonne.php";
class Coach extends Personne{
        private string $styl;
        private int $annExp;
        public function __construct($nom, $email, $nationalite, $salaire, $styl, $annExp){
        parent::__construct($nom, $email, $nationalite, $salaire);
        $this->styl = $styl;
        $this->annExp = $annExp;
    }
    public function getAnnualCost(){
       return ($this->salaire * 0.12);
    }

}