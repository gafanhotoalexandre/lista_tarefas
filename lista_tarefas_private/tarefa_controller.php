<?php

require_once '../lista_tarefas_private/Tarefa.php';
require_once '../lista_tarefas_private/TarefaService.php';
require_once '../lista_tarefas_private/Conexao.php';

$acao = $_GET['acao'] ?? $acao;

if ($acao == 'inserir') {

    $newTask = filter_input(INPUT_POST, 'task');
    if ($newTask) {

        $task = new Tarefa();
        $task->__set('tarefa', $newTask);
    
        $connection = new Conexao();
    
        $tarefaService = new TarefaService($connection, $task);
        $tarefaService->insert();
    
        header('Location: nova_tarefa.php?inclusao=1');
        die();
    
    } else {
        header('Location: nova_tarefa.php?inclusao=0');
        die();
    }
} else if ($acao == 'recuperar') {
    
    $task = new Tarefa();
    $connection = new Conexao();

    // $task->__set('tarefa', $_POST['task']);

    $tarefaService = new TarefaService($connection, $task);
    $tasks = $tarefaService->recover();
   
} else if ($acao == 'atualizar') {
    
    $task = new Tarefa();
    $task->__set('id', $_POST['id'])
            ->__set('tarefa', $_POST['task']);

    $connection = new Conexao();

    $tarefaService = new TarefaService($connection, $task);
    
    if ($tarefaService->update()) {

        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
            die();
        } else {
            header('Location: todas_tarefas.php');
            die();            
        }
    }
} else if ($acao == 'remover') {
    $task = new Tarefa();
    $task->__set('id', $_GET['id']);

    $connection = new Conexao();

    $tarefaService = new TarefaService($connection, $task);
    $tarefaService->delete();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('Location: index.php');
        die();
    } else {
        header('Location: todas_tarefas.php');
        die();            
    }
} else if ($acao == 'marcarRealizada') {
    $task = new Tarefa();
    $task->__set('id', $_GET['id'])
            ->__set('id_status', 2);

    $connection = new Conexao();
    // atribuindo valor do objeto tarefa recém criado à TarefaService
    $tarefaService = new TarefaService($connection, $task);

    $tarefaService->marcarRealizada();

    if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
        header('Location: index.php');
        die();
    } else {
        header('Location: todas_tarefas.php');
        die();            
    }

} else if ($acao == 'recuperarTarefasPendentes') {
    $task = new Tarefa();
    $task->__set('id_status', 1);
    $connection = new Conexao();

    $tarefaService = new TarefaService($connection, $task);
    $tasks = $tarefaService->recuperarTarefasPendentes();
}