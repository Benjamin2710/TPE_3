# TPE_3

- D'Annunzio Benjamín, dannunzio98@gmail.com
- Chatelain Francisco, franchatelain2000@gmail.com



# TEMATICA:
Lista de jugadores de futbol utilizando API con SSR (renderización del lado del servidor con PHP y MySQL).
Se deben poder hacer requests (peticiones) al servidor, con los metodos GET PUT POST DELETE, utilizando Postman o Thunder Client.


# ENDPOINTS:

- Listar Jugadores: Utilizamos el verbo GET para obtener toda la lista de jugadores.
 Endpoint: GET http://localhost/TP/api/jugadores/


- ## Agregar Jugadores: 
 Para agregar jugadores utilizaremos el verbo POST, deberemos usar una clave y un valor en la seccion body de nuestro Postman.

Endpoint: POST http://localhost/TP/api/jugadores/

{
  "nombre": "Lionel Messi",
  "pais": "Portugal",
    ....
}
 
- ## Eliminar Jugador: 
 Utilizaremos el verbo DELETE, y usaremos el id del jugador a eliminar.
 Endpoint: DELETE http://localhost/TP/api/jugadores/2  <- este seria la ID del jugador. 

- ## Editar Jugador: 
  Utilizaremos el verbo PUT y pondremos la id del jugador a modificar.

  A su vez debemos escribir el body de lo que qure
 Endpoint: PUT http://localhost/TP/api/jugadores/2.

  {
  "nombre": "Cristiano Ronaldo",
  "pais": "Portugal",
    ....
}



