<?php

namespace App\Models;

use App\Libraries\Token;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    protected $allowedFields = ['name', 'email', 'password_hash', 'activation_hash', 'reset_hash', 'reset_expires_at'];
    protected $returnType = 'App\Entities\User';
    protected $useTimestamps = true;

    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required|matches[password]'
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'The email field is required.',
            'valid_email' => 'Please enter a valid email address.',
            'is_unique' => 'That email address is taken.'
        ],
        'password_confirmation' => [
            'required' => 'Please confirm the password.',
            'matches' => 'Please enter the same password.'
        ]
    ];

    // Hacer hashing de la contraseña después de la validación
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Función para hashear la contraseña antes de guardarla
    protected function hashPassword(array $data)
    {
        // Asegurarse de que la contraseña se procesa solo después de la validación
        if (isset($data['data']['password'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            // Eliminar los campos de password para que no se guarden directamente
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    // Buscar usuario por email
    public function findByEmail($email)
    { 
        return $this->where('email', $email)->first();
    }

    // Deshabilitar validación de contraseña
    public function disablePasswordValidation()
    { 
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    // Activar usuario por token
    public function activateByToken($token)
    { 
        $token = new Token($token);
        $token_hash = $token->getHash();

        $user = $this->where('activation_hash', $token_hash)->first();

        if ($user !== null) { 
            $user->activate();
            $this->protect(false)->save($user);
        }
    }

    // Obtener usuario para el restablecimiento de contraseña
    public function getUserForPasswordReset($token)
    { 
        $token = new Token($token);
        $token_hash = $token->getHash();

        $user = $this->where('reset_hash', $token_hash)->first();

        if ($user) { 
            if ($user->reset_expires_at < date('Y-m-d H:i:s')) {
                $user = null;
            }
        }

        return $user;
    }
}
