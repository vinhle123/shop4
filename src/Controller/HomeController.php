<?php
namespace App\Controller;
class HomeController extends AppController
{   
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Categories');
        $this->loadModel('Products');
    }

    public function index()
    {  
        $this->set('title_for_layout',TITLE_HOME);
        $categories = $this->Categories->getlisthome();
        $this->set('categories',$categories);
        //
        $products = $this->Products->getlisthome();
        $this->set('products',$products);

        // product random
        $products_randoms = $this->Products->getlisthomeRandom();
        $this->set('products_randoms',$products_randoms);
    }

    public function contact(){
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