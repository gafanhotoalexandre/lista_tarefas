<?php

class Conexao
{
    private $host = 'localhost';
    private $dbName = 'app_lista_tarefas';
    private $user = 'root';
    private $pass = '';

    public function connect()
    {
        try {

            $connection = new PDO(
                "mysql:host=$this->host,dbname=$this->dbName",
                "$this->user",
                "$this->pass",
            );

            return $connection;

        } catch (PDOException $e) {
            echo '<p style="color: red; font-size: 18px;">'. $e->getMessage() .'</p>';
        }
    }
}