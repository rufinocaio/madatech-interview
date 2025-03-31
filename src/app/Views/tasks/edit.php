<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Tarefa!</title>
</head>
<body>
    <div class="container mt-5 w-50">
        <div class="d-flex flex-row gap-2 align-items-center justify-content-between">
            <h1>Editar Tarefa</h1>
        </div>
        <?php 
            $validation = service('validation'); 
            helper('form');
        ?>
        <?= form_open('tasks/update/' . $task['id']) ?>
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= esc($task['title']) ?>" required>
                <?= $validation->getError('title') ?>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= esc($task['description']) ?></textarea>
                <?= $validation->getError('description') ?>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="" disabled>Selecione o status</option>
                    <option value="pendente" <?= ($task['status'] == 'pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="em andamento" <?= ($task['status'] == 'emAndamento') ? 'selected' : '' ?>>Em Andamento</option>
                    <option value="concluída" <?= ($task['status'] == 'concluída') ? 'selected' : '' ?>>Concluída</option>
                </select>
                <?= $validation->getError('status') ?>
            </div>
            <div class="d-flex flex-row-reverse gap-2">
                <button type="submit" class="btn btn-dark">Salvar Alterações</button>
                <a href="<?= base_url('tasks/index') ?>" class="btn btn-light border">Voltar para a lista de tarefas</a>
            </div>
        </form>
        <?= form_close() ?>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>