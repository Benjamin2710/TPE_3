<?php
require_once './app/models/jugadorModel.php';

class jugadoresAPIController {

    private $model;

    public function __construct() {
        $this->model = new jugadorModel();
    }

    public function getJugadores($req, $res) {
        if (isset($req->query->equipo)) {
            $id_equipo = $req->query->equipo;
            $jugadores = $this->model->getJugadoresByEquipoOrdenados($id_equipo);
        } else {
            $jugadores = $this->model->getJugadoresOrdenados();
        }

        return $res->json($jugadores);
    }

    public function getJugador($req, $res) {
        $id_jugador = $req->params->id;

        $jugador = $this->model->getJugador($id_jugador);

        if (!$jugador) {
            return $res->json("El jugador id=$id_jugador no existe", 404);
        }

        return $res->json($jugador);
    }

    public function insertJugador($req, $res) {
        if (empty($req->body->nombre) || empty($req->body->pais) || empty($req->body->posicion)
            || empty($req->body->puntaje) || empty($req->body->fecha_nacimiento)
            || empty($req->body->id_equipo)) {

            return $res->json('Faltan datos', 400);
        }

        $newJugadorId = $this->model->insertJugador(
            $req->body->nombre,
            $req->body->pais,
            $req->body->posicion,
            $req->body->puntaje,
            $req->body->fecha_nacimiento,
            $req->body->id_equipo
        );

        if (!$newJugadorId) {
            return $res->json('Error del servidor', 500);
        }

        $newJugador = $this->model->getJugador($newJugadorId);

        return $res->json($newJugador, 201);
    }

    public function deleteJugador($req, $res) {
        $id_jugador = $req->params->id;

        $jugador = $this->model->getJugador($id_jugador);

        if (!$jugador) {
            return $res->json("El jugador id=$id_jugador no existe", 404);
        }

        $this->model->deleteJugador($id_jugador);

        return $res->json("El jugador con id=$id_jugador fue eliminado", 200);
    }

    public function updateJugador($req, $res) {
        $id_jugador = $req->params->id;

        $jugador = $this->model->getJugador($id_jugador);

        if (!$jugador) {
            return $res->json("El jugador id=$id_jugador no existe", 404);
        }

        // Validación estilo PUT (todos los datos obligatorios)
        if (empty($req->body->nombre) || empty($req->body->pais)
            || empty($req->body->posicion) || empty($req->body->puntaje)
            || empty($req->body->fecha_nacimiento) || empty($req->body->id_equipo)) {

            return $res->json('Faltan datos para actualizar', 400);
        }

        $nombre = $req->body->nombre;
        $pais = $req->body->pais;
        $posicion = $req->body->posicion;
        $puntaje = $req->body->puntaje;
        $fecha_nacimiento = $req->body->fecha_nacimiento;
        $id_equipo = $req->body->id_equipo;

        $this->model->updateJugador(
            $id_jugador,
            $nombre,
            $pais,
            $posicion,
            $puntaje,
            $fecha_nacimiento,
            $id_equipo
        );

        $updatedJugador = $this->model->getJugador($id_jugador);

        return $res->json($updatedJugador, 200);
    }
}


