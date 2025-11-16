<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_2025;charset=utf8', 'root', '');
    }

    public function get($id) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function getAll() {
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($name, $password) {
        $query = $this->db->prepare("INSERT INTO usuarios(usuario, contrasenia) VALUES(?, ?)");
        $query->execute([$name, $password]);
        return $this->db->lastInsertId();
    }
}