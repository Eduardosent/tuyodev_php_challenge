<?php

namespace App;

use Db\ConnectDB;
use PDO;
use InvalidArgumentException;
use PHPUnit\Framework\EmptyStringException;

class TaskController extends ConnectDB{

    protected static $table = 'tasks';

    //metodo para retornar todas las tareas
    public function getTasks(){
        $this->connect();
        $getquery = "SELECT * FROM ". static::$table;
        $execute = static::$db->query($getquery);
        $results = $execute->fetchAll(PDO::FETCH_ASSOC);
        $response = array(
            "data"=>$results
        );
        return json_encode($response);
    }
    //metodo para retornar una tarea por medio del id
    public function getTask($id){
        //Excepcion si el parametro no es valido
        if(!is_string($id) || !is_numeric($id)){throw new InvalidArgumentException('El parametro debe ser un id numerico');};
        //conectar a la bd
        $this->connect();
        $getquery = "SELECT * FROM ". static::$table . " WHERE id='$id'";
        $execute = static::$db->query($getquery);
        $results = $execute->fetch(PDO::FETCH_ASSOC);
        //si no encuentra el elemento con ese id retornara una instruccion
        if(!$results){
            $result = "No existe tarea con ese id asegurate de utilizar una tarea con un id que si exista";
        }else{
            $result = $results;
        }
        $response = array(
            "data"=>$result
        );
        //retorna el parametro encontrado
        return json_encode($response);
    }
    //metodo post para crear una nueva tarea
    public function createTask($title){
        //excepcion si el parametro no es valido
        if(!is_string($title)){throw new InvalidArgumentException('El parametro debe ser un string'); }
        if(empty($title)){throw new EmptyStringException('El titulo no debe estar vacio');};
        $this->connect();
        $postquery = "INSERT INTO " . static::$table . " (title) VALUES ('$title')";
        static::$db->query($postquery);
        //informa que se creo una tarea exitosamente
        $response = array(
            "data"=>"Task created succesfully"
        );
        return json_encode($response);
    }
    public function updateTask($id,$newTitle){
        //validar parametros
        if(!is_string($newTitle)){throw new InvalidArgumentException('El parametro debe ser un numero o un string'); }
        if(!is_numeric($id) || !is_string($id)){throw new InvalidArgumentException('El parametro debe ser un string'); }
        $this->connect();
        //validar si la tarea con el id parametro existe
        $existquery = "SELECT * FROM ". static::$table . " WHERE id=$id";
        $exist = static::$db->query($existquery)->fetch(PDO::FETCH_ASSOC);
        $putquery = "UPDATE ". static::$table . " SET title='$newTitle' WHERE id='$id'";
        if(!$exist){
            $result = "No se encontro esa tarea";
        }else{
            //si existe actualizar y devolver la confirmacion
            static::$db->query($putquery);
            $result = "Tarea actualizada exitosamente";
        }
        $response = array(
            "data"=>$result
        );
        //informar si el id no existe eb la respuesta o confirmar actualizacion
        return json_encode($response);
    }
    //eliminar una tarea
    public function deleteTask($id){
        //excepcion si parametro no es valido
        if(!is_numeric($id)){throw new InvalidArgumentException('The id param must be a Number or String'); }
        $this->connect();
        //consulta para validar si la tarea existe
        $existquery = "SELECT * FROM ". static::$table . " WHERE id=$id";
        $exist = static::$db->query($existquery)->fetch(PDO::FETCH_ASSOC);
        //consulta para eliminar tarea
        $deletequery = "DELETE FROM ". static::$table . "  WHERE id='$id'";

        if(!$exist){
            $result = "No se encontro esa tarea";
        }else{
            //si existe eliminar y devolver la confirmacion
            static::$db->query($deletequery);
            $result = "Tarea eliminada exitosamente";
        }
        static::$db->query($deletequery);
        $response = array(
            "data"=>$result
        );
        return json_encode($response);
    }
}
?>