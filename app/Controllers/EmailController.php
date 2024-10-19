<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EmailController extends BaseController
{
    public function testEmail()
    {
        $email = \Config\Services::email();

   
        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'smtp.gmail.com'; 
        $config['SMTPUser'] = 'joselinee076@gmail.com'; 
        $config['SMTPPass'] = 'vkacbclhvdampvgj'; 
        $config['SMTPPort'] = 587;
        $config['mailType'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";

        $email->initialize($config);

        $email->setFrom('smtpproyecto@gmail.com', 'SMTP');
        $email->setTo('joselinee076@gmail.com');
        $email->setSubject('Prueba de Envío de Correo');
        $email->setMessage('<p>Este es un mensaje de prueba para verificar el envío de correos electrónicos en CodeIgniter.</p>');

        if ($email->send()) {
            return 'Correo enviado exitosamente.';
        } else {
            return $email->printDebugger(['headers']);
        }
    }
}
