<?php
class jugadorModel {

    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=localhost;dbname=tpe_2025;charset=utf8',
            'root',
            ''
        );
    }

    public function getJugadoresOrdenados() {
        $query = $this->db->prepare('SELECT * FROM jugadores ORDER BY puntaje DESC');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJugadoresByEquipoOrdenados($id_equipo) {
        $query = $this->db->prepare('
            SELECT * FROM jugadores 
            WHERE id_equipo = ?
            ORDER BY puntaje DESC
        ');
        $query->execute([$id_equipo]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getJugador($id_jugador) {
        $query = $this->db->prepare('SELECT * FROM jugadores WHERE id_jugador = ?');
        $query->execute([$id_jugador]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insertJugador($nombre, $pais, $posicion, $puntaje, $fecha_nacimiento, $id_equipo) {
        $query = $this->db->prepare('
            INSERT INTO jugadores (nombre, pais, posicion, puntaje, fecha_nacimiento, id_equipo)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $query->execute([$nombre, $pais, $posicion, $puntaje, $fecha_nacimiento, $id_equipo]);

        return $this->db->lastInsertId();
    }

    public function deleteJugador($id_jugador) {
        $query = $this->db->prepare('DELETE FROM jugadores WHERE id_jugador = ?');
        $query->execute([$id_jugador]);
    }

    public function updateJugador($id_jugador, $nombre, $pais, $posicion, $puntaje, $fecha_nacimiento, $id_equipo) {
        $query = $this->db->prepare('
            UPDATE jugadores
            SET nombre = ?, pais = ?, posicion = ?, puntaje = ?, fecha_nacimiento = ?, id_equipo = ?
            WHERE id_jugador = ?
        ');

        $query->execute([$nombre, $pais, $posicion, $puntaje, $fecha_nacimiento, $id_equipo, $id_jugador]);
    }
}

