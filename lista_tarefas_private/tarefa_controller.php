<?php

require_once '../lista_tarefas_private/Tarefa.php';
require_once '../lista_tarefas_private/TarefaService.php';
require_once '../lista_tarefas_private/Conexao.php';

$acao = $_GET['acao'] ?? $acao;

if ($acao == 'inserir') {

    $task = new Tarefa();
    $task->__set('tarefa', $_POST['task']);

    $connection = new Conexao();

    $tarefaService = new TarefaService($connection, $task);
    $tarefaService->insert();

    header('Location: nova_tarefa.php?inclusao=1');

} else if ($acao == 'recuperar') {
    
    $task = new Tarefa();
    $connection = new Conexao();

    // $task->__set('tarefa', $_POST['task']);

    $tarefaService = new TarefaService($connection, $task);
    $tasks = $tarefaService->recover();
   
}