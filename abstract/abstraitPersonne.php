<?php
abstract class Personne{
        protected string $nom;
        protected string $email;
        protected string $nationalite;
        protected float $salaire;
    public function __construct($nom, $email, $nationalite, $salaire){
        $this->nom = $nom;
        $this->email = $email;
        $this->nationalite = $nationalite;
        $this->salaire = $salaire;
    }
    abstract public function getAnnualCost();
}