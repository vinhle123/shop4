<?php
namespace App\Controller;
class ContactController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Contact');
    }

    public function admin()
    {   $this->viewBuilder()->setLayout('admin');


        $this->paginate = array(
            'order' => array('Contact.id' => 'desc'),
            'limit' => 10
        );
        $contacts = $this->paginate($this->Contact);
        $this->set('contacts',$contacts);
        $this->set('title_for_layout','contact');
        $this->set('menu_active','orders');
    }

    public function delete($id = 0){
        $this->autoRender = false;
        $this->loadModel('Products');
        $check = $this->Contact->find()->where(['id' => $id])->first();
        if(!empty($check)){
           $this->Contact->deleteAll(['id' => $id]);
           $this->Flash->success('Xóa Thành Công');
        }else{
            $this->Flash->success('Xóa Thành Công');
        }
        $this->redirect('/contact/admin');
        
    }
    
}