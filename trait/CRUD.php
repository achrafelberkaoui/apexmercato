<?php

trait CRUD
{
    protected PDO $pdo;
    protected string $table;

    public function conne(PDO $pdo) : void{
        $this->pdo = $pdo;
    }

    public function creatNew(array $Data) : bool{
        var_dump($this);
        $keeys = implode(",", array_keys($Data));
        $valuues = ":" . implode(",:", array_keys($Data));
        $sql = "INSERT INTO {this->table}($keeys) VALUES($valuues)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();

    }
}



