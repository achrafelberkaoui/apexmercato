<?php
namespace Trait;
use PDO;

trait Crud
{
    protected PDO $con;
    protected string $table;

    public function conne(PDO $con, $table) : void{
        $this->con = $con;
        $this->table = $table;
    }

    public function creatNew(array $data) : bool{
        $keeys = implode(",", array_keys($data));
        $valuues = ":" . implode(",:", array_keys($data));
        $sql = "INSERT INTO {$this->table}($keeys) VALUES($valuues)";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute($data);

    }
    public function update($id, $data): bool{
        $set = "";
        foreach ($data as $key => $value) {
            $set = $set . "$key = :$key,";
        }
        $set = rtrim($set, ",");
        $sql = "UPDATE {$this->table} SET $set WHERE id = $id";

        $stmt = $this->con->prepare($sql);
        return $stmt->execute($data);
    }
    public function delete($id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([":id"=>$id]);
    }
    public function all(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): array|false {
        $stmt = $this->con->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([":id"=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



