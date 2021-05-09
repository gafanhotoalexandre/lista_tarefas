<?php

class TarefaService
{
    private $connection;
    private $task;

    public function __construct(Conexao $c, Tarefa $t)
    {
        $this->connection = $c->connect();
        $this->task = $t;
    }

    public function insert()
    {
        $query = 'INSERT INTO tb_tarefas(tarefa)VALUES(:task)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':task', $this->task->__get('tarefa'));

        $stmt->execute();
    }

    public function recover()
    {

    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}