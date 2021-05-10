<?php
	$acao = 'recuperarTarefasPendentes';
	require_once 'tarefa_controller.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(taskId, taskTxt)
			{

				// criar form de edição
				let form = document.createElement('form')
				form.action = 'index.php?pag=index&acao=atualizar'
				form.method = 'POST'
				form.className = 'row'
				// criar input para entrada do texto
				let input = document.createElement('input')
				input.type = 'text'
				input.name = 'task'
				input.value = taskTxt
				input.className = 'col-md-9 form-control'
				// criar input hidden para receber o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = taskId
				// criar button para envio do form
				let btn = document.createElement('button')
				btn.type = 'submit'
				btn.className = 'col-md-3 btn btn-info'
				btn.innerHTML = 'Atualizar'

				// ADICIONAR ELEMENTOS NA PÁGINA
				// incluir input no form
				form.appendChild(input)
				// incluir input hidden no form
				form.appendChild(inputId)
				// incluir button no form
				form.appendChild(btn)

				// selecionar a div task
				let task = document.querySelector('#task_' + taskId)
				// limpar o conteúdo interno da div
				task.innerHTML = ''
				// incluir form de edição na página
				task.insertBefore(form, task[0])
			}

			function remover(id)
			{
				if (window.confirm('Tem certeza que deseja apagar o registro?')){
					location.href = 'index.php?pag=index&acao=remover&id=' + id
				}
			}

			function marcarRealizada(id)
			{
				location.href = 'index.php?pag=index&acao=marcarRealizada&id=' + id
			}
		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<?php foreach ($tasks as $key => $task): ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id="task_<?= $task->id ?>">
											<?= $task->tarefa ?>
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger"
											onclick="remover(<?= $task->id ?>)"></i>
											<i class="fas fa-edit fa-lg text-info"
											onclick="editar(<?= $task->id ?>, '<?= $task->tarefa ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success"
												onclick="marcarRealizada(<?= $task->id ?>)"></i>
										</div>
									</div>
								<?php endforeach ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>