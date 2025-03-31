<?php
namespace App\Controllers;

use App\Models\Task;

class TaskController extends BaseController
{
    public function index(): string
    {
        $tasks = model('Task')->findAll();
        return view('tasks/index', ['tasks' => $tasks]);
    }

    public function create(): string
    {
        return view('tasks/create');
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
                'in_list' => 'O campo Status deve ser um dos valores pré apresentados.'
            ]],
        ];
        if (!$this->validate($rules)) {
            redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        model('Task')->save($this->request->getPost());
        return redirect()->to('/tasks/index');
    }  

    public function edit(int $id): string
    {
        $task = model('Task')->find($id);
        return view('tasks/edit', ['task' => $task]);
    }

    public function update(int $id)
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
                'in_list' => 'O campo Status deve ser um dos valores pré apresentados.'
            ]],
        ];
        if (!$this->validate($rules)) {
            redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        model('Task')->update($id, $this->request->getPost());
        return redirect()->to('/tasks/index');
    }

    public function destroy(int $id)
    {
        model('Task')->delete($id);
        return redirect()->to('/tasks/index');
    }

}