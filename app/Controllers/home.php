<?php namespace App\Controllers;

class home extends BaseController
{
    public function index(): string
    {   
        return view('home/index');
    }

    public function testEmail()
{
    $email = service('email');

    $email->setTo('smtpproyecto@gmail.com');

    $email->setSubject('A test email');

    $email->setMessage('<h1>Hello world</h1>');

    if ($email->send()) {

        return "Message sent";

    } else {
        
        return $email->printDebugger();
    }
}

}