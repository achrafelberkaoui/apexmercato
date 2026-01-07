<?php
namespace Abstract;
abstract class Personne{
        protected ?string $nom;
        protected ?string $email;
        protected ?string $nationalite;
        protected ?int $id_equipe;
    public function __construct($nom, $email, $nationalite, $id_equipe){
        $this->nom = $nom;
        $this->email = $email;
        $this->nationalite = $nationalite;
        $this->id_equipe = $id_equipe;
    }
    abstract public function getAnnualCost();
}