<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use App\Models\UserModel; 

class Signup extends BaseController
{
    public function new()
    {
        return view("signup/new"); 
    }
    public function create()
{ 
    $model = new UserModel();

    $rules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]', 
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]' 
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
                         ->with('errors', $this->validator->getErrors())
                         ->withInput();
    }

    $email = $this->request->getPost('email');
    $existingUser = $model->where('email', $email)->first();

    if ($existingUser) {
        return redirect()->to('/signup/new')->with('error', 'El correo electrónico ya está en uso.');
    }

    $user = new \App\Entities\User($this->request->getPost());

    $user->startActivation(); 

    $this->sendActivationEmail($user);

    if ($model->insert($user)) { 
        return redirect()->to('/signup/success');
    } else {
        return redirect()->back()
                         ->with('errors', $model->errors())
                         ->with('warning', 'Invalid data')
                         ->withInput();
    }
}

    public function success()
    {
        return view('Signup/success');
    }

    public function activate($token)
    { 
        $model = new \App\Models\UserModel;

        $model->activateByToken($token);

        return view('Signup/activated');
    }

    private function sendActivationEmail($user)
    { 
        $email = service('email');

        $email->setTo($user->email);
    
        $email->setSubject('Account activation');

        $message = view('Signup/activation_email', [ 
            'token' => $user->token
    ]);
    
        $email->setMessage($message);
    
        $email->send();
    }       
}