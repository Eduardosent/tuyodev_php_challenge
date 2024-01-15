<?php

require 'app.php';
use App\TaskController;

//instanciando el controlador
$task = new TaskController();

//body para recibir parametros en formato json
$body = json_decode(file_get_contents("php://input"),true);

//devolver en formato json
header("Content-type: application/json; charset=utf-8");

//switch que valida el metodo para retornar una funcion del controlador
switch($_SERVER["REQUEST_METHOD"]){
    case "GET":
        if(empty($_GET["task"])){
            echo $task->getTasks();
        }else{
            echo $task->getTask($_GET["task"]);
        }
        break;
    case "POST":
        echo $task->createTask($body["title"]);
        break;
    case "PUT":
        echo $task->updateTask($_GET["task"],$body["title"]);
        break;
    case "DELETE":
        echo $task->deleteTask($_GET["task"]);
        break;
    default:
        echo json_encode("No existe esa url");
        break;
}
?>