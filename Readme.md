Como ejeutar esta api de y tener una lista de Tareas Localmente :

1.crea una base de datos
(si ya tienes Mysql instalado sino debes instalarlo)
usando MySQL puedes ejecutar:
CREATE DATABASE taskList;

crea la tabla:
CREATE TABLE tasks (
id INT(11) auto_increment ,
title VARCHAR(255) NOT NULL,
primary key (id)
);

2.Clona el repositorio:
git clone <en enlace de este repositorio>

3.Una vez tengas la carpeta del proyecto 
ejecuta:
composer update

4.modifica el archivo /src/config/ConnectDB.php,
en:
new PDO("mysql:local=localhost;dbname=taskList","root","tucontraseña")
colocando tus credenciales de tu servidor, nommbre de la bd, tu usuario y contraseña

5.Ejecuta las pruebas unitarias con este comando:
./vendor/bin/phpunit tests

6.Usando las rutas:
(modifica el puerto segun el puerto que tu estes usando en mi caso es :8080)

GET http://localhost:8080/api/tasks [obtendras todas las tareas]
GET http://localhost:8080/api/tasks/1 [obtendras la tarea que tenga el id numero 1] (si existe sino te dira que el id de esa tarea no existe)
POST http://localhost:8080/api/tasks [craras una nueva tarea] (asegurate que el parametro title sea un string y no este vacio) por ejemplo: 
{
    "title":"New Task"
}
en el body
PUT http://localhost:8080/api/tasks/1 [actualizaras una tarea con el id 1] (si existe sino te dira que el id de esa tarea no existe)
DELETE  http://localhost:8080/api/tasks/1 [eliminaras una tarea con el id 1] (si existe sino te dira que el id de esa tarea no existe)

Gracias por tu tiempo asi tendras un api local de Tareas

mi portafolio: mon-portfolio-new.netlify.app
mi numero: +503 74489102

