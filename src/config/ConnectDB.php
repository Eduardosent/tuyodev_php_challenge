<?php

namespace Db;

use PDO;
use Exception;

class ConnectDB {

    static $db;

    //metodo para conectar a la base de datos
    public static function connect(){
        try{
            $database = new PDO("mysql:local=localhost;dbname=taskList","root","3dugomez");
            static::$db = $database;
        }catch(Exception $e){
            print "Error DB:".$e->getMessage()."</br>";
            die();
        }
    }
}

?>