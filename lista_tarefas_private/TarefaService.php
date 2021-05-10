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
        $query = 'UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':tarefa', $this->task->__get('tarefa'));
        $stmt->bindValue(':id', $this->task->__get('id'));
        
        return $stmt->execute();
    }

    public function delete()
    {
        $query = 'DELETE FROM tb_tarefas WHERE id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $this->task->__get('id'));
        $stmt->execute();
    }

    public function marcarRealizada()
    {
        $query = 'UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id_status', $this->task->__get('id_status'));
        $stmt->bindValue(':id', $this->task->__get('id'));
        
        return $stmt->execute();

    }

    public function recuperarTarefasPendentes()
    {
        $query = '
            SELECT
                t.id, s.status, t.tarefa
            FROM
                tb_tarefas AS t
                LEFT JOIN tb_status AS s ON (t.id_status = s.id)
            WHERE
                t.id_status = :id_status
        ';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id_status', $this->task->__get('id_status'));
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }
}