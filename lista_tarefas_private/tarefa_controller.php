<?php

require_once '../lista_tarefas_private/Tarefa.php';
require_once '../lista_tarefas_private/TarefaService.php';
require_once '../lista_tarefas_private/Conexao.php';

echo '<pre>';
    print_r($_POST);
echo '</pre>';

$task = new Tarefa();
$task->__set('tarefa', $_POST['task']);

$connection = new Conexao();

$tarefaService = new TarefaService($connection, $task);
$tarefaService->insert();

echo '<pre>';
    print_r($tarefaService);
echo '</pre>';
