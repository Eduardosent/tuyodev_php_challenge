<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use App\TaskController;
use PHPUnit\Framework\EmptyStringException;

class TaskTest extends TestCase
{
    private $task;

    public function setUp() : void {
        $this->task = new TaskController();
    }
    //pruebas unitarias para el metodo crear
    public function testCreateIsNotStringParamException(){
        $this->expectException(InvalidArgumentException::class);
        $this->task->createTask(1);
    }
    //prueba para verificar que el titulo no este vacio
    public function testCreateTaskIsNotEmpty(){
        $this->expectException(EmptyStringException::class);
        $this->task->createTask("");
    }
    //pruebas unitarias para el metodo actualizar 
    public function testUpdateIsNotStringParamException(){
        $this->expectException(InvalidArgumentException::class);
        $this->task->updateTask('ñ',1);
    }
}