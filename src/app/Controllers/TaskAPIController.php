<?php

namespace App\Controllers;

use App\Models\Task;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class TaskAPIController extends ResourceController
{
    public function index()
    {
        return $this->respond(model('Task')->findAll());
    }

    public function show($id = null)
    {
        $task = model('Task')->find($id);
        if ($task) {
            return $this->respond($task);
        } else {
            return $this->failNotFound('Tarefa não encontrada');
        }
    }

    public function store()
    {
        $rules = [
            'title'       => ['label' => 'Título', 'rules' => 'required|max_length[255]', 'errors' => [
                'required' => 'O campo título é obrigatório.',
                'max_length' => 'O campo título deve ter no máximo 255 caracteres.'
            ]],
            'description'       => ['label' => 'description', 'rules' => 'permit_empty|max_length[5000]', 'errors' => [
                'max_length' => 'O campo descrição deve ter no máximo 5000 caracteres.'
            ]],
            'status'       => ['label' => 'status', 'rules' => 'permit_empty|in_list[pendente,em andamento,concluída]', 'errors' => [
                'in_list' => 'O campo Status deve ser "pendente", "em andamento" ou "concluída".'
            ]],
        ];
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $task = new Task();
        $task_data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status') ? $this->request->getVar('status') : 'pendente',
        ];
        $task->save($task_data);
        $task_data['id'] = $task->getInsertID();

        return $this->respondCreated($task_data);
    }

    public function update($id  = null)
    {
        if (!model('Task')->find($id)) {
            return $this->failNotFound('Tarefa não encontrada');
        }

        $rules = [
            'title'       => ['label' => 'Título', 'rules' => 'required|max_length[255]', 'errors' => [
                'required' => 'O campo título é obrigatório.',
                'max_length' => 'O campo título deve ter no máximo 255 caracteres.'
            ]],
            'description'       => ['label' => 'description', 'rules' => 'permit_empty|max_length[5000]', 'errors' => [
                'max_length' => 'O campo descrição deve ter no máximo 5000 caracteres.'
            ]],
            'status'       => ['label' => 'status', 'rules' => 'permit_empty|in_list[pendente,em andamento,concluída]', 'errors' => [
                'in_list' => 'O campo Status deve ser "pendente", "em andamento" ou "concluída".'
            ]],
        ];
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $task_data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status')
        ];
        model('Task')->update($id, $task_data);
        return $this->respondUpdated($task_data);
    }

    public function destroy($id = null)
    {
        model('Task')->delete($id);
        return $this->respondDeleted(['message' => 'Tarefa removida com sucesso.']);
    }

}
