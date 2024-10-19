<?php

namespace App\Controllers;

use App\Entities\Task;

class Tasks extends BaseController
{
    private $model;

    private $current_user;
    
    public function __construct()
    { 
        $this->model = new \App\Models\TaskModel();
        $this->current_user = service('auth')->getCurrentUser();
    }

    public function index()
{
   if ($this->current_user) {
    $data = $this->model->paginateTasksByUserId($this->current_user->id);
    return view('Tasks/index', [
        'tasks' => $data,
        'pager' => $this->model->pager
    ]);
} else {
    return redirect()->to('/login')->with('warning', 'Debes iniciar sesión para ver tus tareas.');
}

}
    public function show($id)
    {
        $task = $this->getTaskOr404($id);

        return view('Tasks/show', [
            'task' => $task
        ]);
    }

    public function new() 
    {
        $task = new Task;

        return view('Tasks/new', [ 
            'task' => $task
        ]);
    }

    public function create()
{
    $task = new Task($this->request->getPost());

    $user = service('auth')->getCurrentUser();
    
    $auth = service('auth');
    $user = $auth->getCurrentUser(); 

    $task->user_id = $this->current_user->id;
    
    $task->user_id = $user->id; 

    if ($this->model->insert($task)) {
        return redirect()->to("/tasks/show/{$this->model->insertID()}")
                         ->with('info', 'Task created successfully');
    } else {
        return redirect()->back()
                         ->with('errors', $this->model->errors())
                         ->with('warning', 'Invalid data')
                         ->withInput();
    }
}


    public function edit($id)
    {
        $task = $this->getTaskOr404($id);
    
        return view('Tasks/edit', [
            'task' => $task
        ]);
    }
    
    public function update($id)
    { 
        $task = $this->getTaskOr404($id);

        $task->fill($this->request->getPost());

        if ( ! $task->hasChanged()) { 
            return redirect()->back()
                             ->with('warning', 'Nothing to update')
                             ->withInput();
        }
        
        if ($this->model->save($task)) {
            return redirect()->to("/tasks/show/$id")
                             ->with('info', 'Task update successfully');
        } else {
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid data')
                             ->withInput();
        }
    }

    public function delete($id)
{
   
    $task = $this->getTaskOr404($id);

    if ($this->request->getMethod() === 'post') { 

        $this->model->delete($id);

        return redirect()->to('/tasks')
                         ->with('info', 'Task deleted');
    }

    return view('tasks/delete', [ 
        'task' => $task
    ]);
}

private function getTaskOr404($id)
{ 

    /*
    $task = $this->model->find($id);

    if ($task !== null && ($task->user_id !== $user->id)) { 

        $task = null;
    }
    */

    $task = $this->model->getTaskByUserId($id, $this->current_user->id);

    if ($task === null) { 

    throw new \CodeIgniter\Exceptions\PageNotFoundException("Task with id $id not found");

    }
      

    return $task;
}


}