Como ejeutar esta api de y tener una lista de Tareas Localmente :

1.crea una base de datos
(si ya tienes Mysql instalado sino debes instalarlo)
usando MySQL puedes ejecutar:
CREATE DATABASE task;

crea la tabla:
CREATE TABLE tasks (
id INT(11) auto_increment ,
title VARCHAR(255) NOT NULL,
primary key (id)
);

2.
