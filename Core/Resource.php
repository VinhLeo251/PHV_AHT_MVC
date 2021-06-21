<?php

namespace MVC\Core;

use MVC\Config\Database;
use PDO;

class Resource implements ResourceModelInterface
{
    private $id;
    private $table;
    private $model;
    
    public function _init($table, $id, $model)
    {
        $this->id = $id;
        $this->table = $table;
        $this->model = $model;
    }
    public function save($model)
    {
        $place = [];
        $placeName = [];
        $data = [];
        $properties = $model->getProperties();
        if ($model->id === null) {
            unset($properties['id']);
        }
        foreach ($properties as $key => $value) {
            array_push($place, ':' . $key);
            array_push($placeName, $key . '=:' . $key); 
        }
        $placeName = implode(',', $placeName);
        $columnString = implode(',', array_keys($properties));
        $placeHolder = implode(',', $place);
        if ($model->id === null) {
            $sql_insert = "INSERT INTO {$this->table} ({$columnString}, created_at, updated_at) VALUES ({$placeHolder},:created_at,:updated_at)";
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = array("created_at" => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'));
            $req = Database::getBdd()->prepare($sql_insert);
            $data = array_merge($properties, $date);
            return $req->execute($data);
        } else {
            $sql_update = "UPDATE {$this->table} SET " . $placeName . ',updated_at =:updated_at WHERE id=:id';
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = array("id" => $model->id, 'updated_at' => date('Y-m-d H:i:s'));
            $req = Database::getBdd()->prepare($sql_update);
            $data = array_merge($properties, $date);
            return $req->execute($data);
        }
    }
    public function delete($model)
    {
        $sql = "DELETE FROM {$this->table} WHERE id=:id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([':id' => $model->id]);
    }
    public function get($id)
    {
        $sql = "SELECT* FROM {$this->table} WHERE id=:id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(['id' => $id]);
        return $req->fetch();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(\PDO::FETCH_OBJ);
    }
}
