<?php
namespace App\Controller;
class UsersController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Users');
    }

    public function login()
    {  
       $this->viewBuilder()->setLayout('login');

    }

    public function checklogin(){
        $this->autoRender = false;
        $data = $this->request->getData();
        if(empty($data['username'])){
             $this->_jsonError('Vui lòng nhập tài khoản');exit();
        }
        if(empty($data['password'])){
             $this->_jsonError('Vui lòng nhập mật khẩu');exit();
        }
        $user = $this->Users->find()->where(['username' => $data['username'],'password'=> base64_encode($data['password'])])->first();
        if(empty($user)){
            $this->_jsonError('Tài khoản hoặc mật khẩu chưa đúng');exit();
        }else{
            $session = $this->getRequest()->getSession();
            if(empty($session->read('login'))){
                $session->write('login', 1);
            }
            $this->_jsonSuccess();exit();
        }


    }
    
}