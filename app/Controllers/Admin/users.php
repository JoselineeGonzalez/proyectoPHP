<?php

namespace App\Controllers\Admin;

use App\Entities\User;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel(); 
    }

    public function index()
    {
        $data = [
            'users' => $this->userModel->paginate(5), 
            'pager' => $this->userModel->pager 
        ];

        return view('Admin/Users/index', $data); 
    }

    public function show($id)
    {
        $user = $this->userModel->find($id); 

        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("No se ha encontrado al usuario con ID: $id");
        }

        return view('Admin/Users/show', ['user' => $user]); 
    }

    public function new()
    { 
        $user = new User;

        return view('Admin/Users/new', [
            'user' => $user
        ]);
    }

    public function create()
    { 
        $user = new User($this->request->getPost());

        if ($this->userModel->protect(false)
                            ->insert($user)) { 

            return redirect()->to("/admin/users/show/{$this->userModel->insertID()}")
                             ->with('info', 'User created successfully'); 

        } else {

            return redirect()->back()
                             ->with('errors', $this->userModel->errors()) 
                             ->with('warning', 'Invalid data')
                             ->withInput(); 
        }
    }

    public function edit($id)
    {
        $user = $this->getUserOr404($id);
    
        return view('Admin/Users/edit', [
            'user' => $user
        ]);
    }

    public function update($id)
{
    $user = $this->getUserOr404($id);

    $post = $this->request->getPost();
    $post['is_admin'] = isset($post['is_admin']) ? $post['is_admin'] : '0'; 

    if (empty($post['name']) && empty($post['email']) && $post['is_admin'] === '0' && empty($post['password'])) {
        return redirect()->back()
                         ->with('warning', 'No data to update')
                         ->withInput();
    }

    if (empty($post['password'])) {
        $this->userModel->disablePasswordValidation();
        unset($post['password']);
        unset($post['password_confirmation']);
    } else {

        if ($post['password'] !== $post['password_confirmation']) {
            return redirect()->back()
                             ->with('warning', 'Please confirm the password')
                             ->withInput();
        }

        if (strlen($post['password']) < 6) {
            return redirect()->back()
                             ->with('warning', 'The password field must be at least 6 characters in length.')
                             ->withInput();
        }

        $post['password_hash'] = password_hash($post['password'], PASSWORD_DEFAULT);
        unset($post['password']);
        unset($post['password_confirmation']);
    }

    $user->fill($post);

    if (!$user->hasChanged()) {
        return redirect()->back()
                         ->with('warning', 'Nothing to update')
                         ->withInput();
    }

    if ($this->userModel->protect(false)->save($user)) {
        return redirect()->to("/admin/users/show/$id")
                         ->with('info', 'User updated successfully');
    } else {
        return redirect()->back()
                         ->with('errors', $this->userModel->errors())
                         ->with('warning', 'Invalid data')
                         ->withInput();
    }
}


public function delete($id)
{
   
    $user = $this->getUserOr404($id);

    if ($this->request->getMethod() === 'post') { 

        $this->userModel->delete($id);

        return redirect()->to('/admin/users')
                         ->with('info', 'User deleted');
    }

    return view('Admin/Users/delete', [ 
        'user' => $user
    ]);
}
    private function getUserOr404($id)
{
    $user = $this->userModel->where('id', $id)->first();

    if ($user === null) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("No se ha encontrado al usuario con ID: $id");
    }

    return $user;

}

}