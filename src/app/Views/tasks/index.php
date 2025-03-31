<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tarefas</title>
</head>
<body>
    <div class="container mt-5 d-grid gap-3 w-50">
        <div class="d-flex flex-row gap-2 align-items-center justify-content-between">
            <h2>Tarefas</h2>
            <a href="<?= base_url('tasks/create') ?>" class="btn btn-dark">Adicionar Tarefa</a>
        </div>
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="card">
                    <div class="card-header">
                        <?php switch ($task['status']):
                            case 'pendente':
                                echo '<span class="badge bg-secondary">Pendente</span>';
                                break;
                            case 'em andamento':
                                echo '<span class="badge bg-dark">Em Andamento</span>';
                                break;
                            case 'concluída':
                                echo '<span class="badge bg-success ">Concluída</span>';
                                break;
                        endswitch; ?>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><?= esc($task['title']) ?></h5>
                            <p class="card-text">Descrição: <?= esc($task['description']) ?></p>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <a href="<?= base_url('tasks/edit/' . $task['id']) ?>" class="btn btn-light border">
                            <i class="bi bi-trash"></i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                Editar
                            </a>
                            <form action="<?= base_url('tasks/destroy/' . $task['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Deseja excluir a tarefa <?= esc($task['title']) ?>?')">
                                <?= csrf_field() ?>
                                <button id="delete-button" type="submit" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                    </svg>
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="container mt-5">
                <p>Nenhuma tarefa encontrada.</p>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>   
</body>
</html>