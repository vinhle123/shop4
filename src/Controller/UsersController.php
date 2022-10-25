<?php
namespace App\Controller;
class UsersController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Categories');
        $this->loadModel('Products');
    }

    public function login()
    {  
       $this->viewBuilder()->setLayout('login');
    }
    
}