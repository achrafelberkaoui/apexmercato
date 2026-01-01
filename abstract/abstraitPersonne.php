<?php
abstract class Personne{
        protected string $nom;
        protected string $email;
        protected string $nationalite;
    public function __construct($nom, $email, $nationalite){
        $this->nom = $nom;
        $this->email = $email;
        $this->nationalite = $nationalite;
    }
    abstract public function getAnnualCost();
}