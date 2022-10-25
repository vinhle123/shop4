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
    {   
        $this->_check_login();
        $this->viewBuilder()->setLayout('admin');


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
        $this->_check_login();
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

    public function save(){
        $this->autoRender = false;
        $data = $this->request->getData();
        if(empty($data['name'])){
             $this->_jsonError('Vui lòng nhập tên quý khách hàng');exit();
        }

        if(empty($data['email'])){
             $this->_jsonError('Vui lòng nhập email quý khách hàng');exit();
        }

        if(empty($data['phone'])){
             $this->_jsonError('Vui lòng nhập số điện thoại quý khách hàng');exit();
        }

        if(empty($data['message'])){
             $this->_jsonError('Vui lòng nhập nội dung');exit();
        }

        $this->loadModel('Contact');

        $contactEntity = $this->Contact->newEmptyEntity();
        $contactEntity = $this->Contact->patchEntity($contactEntity, $data);
        $contactEntity->created = date('Y-m-d H:i:s');
        if($this->Contact->save($contactEntity)){
            $this->_jsonSuccess();exit();
        }else{
            $this->_jsonError('Đã có lỗi xảy ra vui lòng thử lại');exit();
        }

    }
    
}