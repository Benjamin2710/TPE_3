<?php
require_once './app/models/jugadorModel.php';
class jugadoresAPIController{
    private $model;

    public function __construct() {
        $this->model = new jugadorModel();

        // no hay vista en la API REST
    }

   public function getJugadores($req, $res) {
    // Si el cliente sabe cual es y envía ?equipo=ID filtramos por equipo (el id que tiene la tabla de jugador -> id_equipo)
    if (isset($req->query->equipo)) {

        $id_equipo = $req->query->equipo;

        // Pedimos los jugadores del equipo, ya ordenados por puntaje DESC
        $jugadores = $this->model->getJugadoresByEquipoOrdenados($id_equipo);

    } else {
        // Pedimos todos los jugadores ordenados por puntaje DESC
        $jugadores = $this->model->getJugadoresOrdenados();
    }

    // Respuesta con 200 OK
    return $res->json($jugadores);
}

    public function getJugador($req, $res) {
        // obtengo el ID que viene como parámetro del endpoint
        $id_jugador = $req->params->id;

        $jugador = $this->model->getJugador($id_jugador);
        
        if (!$jugador) {
            return $res->json("el id=$id_jugador no existe", 404);
        }

        return $res->json($jugador);
    }

    public function insertJugador($req, $res) {
        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($req->body->nombre) || empty($req->body->pais) || empty($req->body->posicion) || empty($req->body->puntaje) || empty($req->body->fecha_nacimiento) || empty($req->body->id_equipo)) {
            return $res->json('Faltan datos', 400);
        }

           // Insertar el jugador directamente
        $newJugadorId = $this->model->insert(
            $req->body->nombre,
            $req->body->pais,
            $req->body->posicion,
            $req->body->puntaje,
            $req->body->fecha_nacimiento,
            $req->body->id_equipo
            );

        // Si hubo error en el modelo
        if ($newJugadorId == false) {
            return $res->json('Error del servidor', 500);
        }

        // Obtener el jugador recién creado
        $newJugador = $this->model->getJugador($newJugadorId);

        // Devolverlo con código 201 Created
        return $res->json($newJugador, 201);
    }


    public function deleteJugador($req, $res) {
        $id_jugador = $req->params->id;
        $jugador = $this->model->getJugador($id_jugador);
    
        if (!$jugador) {
            return $res->json("el jugador id=$id_jugador no existe", 404);
        }

        $this->model->deleteJugador($id_jugador);

        return $res->json("el jugador con el id=$id_jugador se eliminó", 204);
    }
    


    
    public function updateJugaddor($req, $res) {
        $id_jugador = $req->params->id;
        $jugador = $this->model->getJugador($id_jugador);
    
        if (!$jugador) {
            return $res->json("el jugador id=$id_jugador no existe", 404);
        }

        if (empty($req->body->nombre) 
            || empty($req->body->pais)
            || empty($req->body->posicion)
            || empty($req->body->puntaje)
            || empty($req->body->fecha_nacimiento)
            || empty($req->body->id_equipo)) {
            // En una petición PUT se deben enviar todos los campos .
            // Si solo queremos modificar algunos, el método correcto sería PATCH.
            return $res->json('Faltan datos', 400);
        }

            $req->body->nombre,
            $req->body->pais,
            $req->body->posicion,
            $req->body->puntaje,
            $req->body->fecha_nacimiento,
            $req->body->id_equipo

        $this->model->updateJugador($id_jugador, $nombre, $pais, $posicion, $puntaje, $fecha_nacimiento, $id_equipo);

        $updatedJugador = $this->model->getJugador($id_jugador);
        return $res->json($updatedJugador, 201); 
    }
}

