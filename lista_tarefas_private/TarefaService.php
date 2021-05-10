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
        $query = '
            SELECT
                t.id, s.status, t.tarefa
            FROM
                tb_tarefas AS t
                LEFT JOIN tb_status AS s ON (t.id_status = s.id)
        ';
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}