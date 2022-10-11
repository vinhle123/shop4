<?php
namespace App\Controller;
class CategoriesController extends AppController
{   
   
   
    public function admin()
    {   
        $this->viewBuilder()->setLayout('admin');

        $this->loadModel('Categories');
        $this->loadModel('Products');
      
        $cond = array();

        if($this->request->is('post')){

            if(!empty($this->request->getData('search'))){
                $cond = array('Categories.name like' => '%'.$this->request->getData('search').'%');
            }
          
        }

        $this->paginate = array(
            'conditions' => $cond,
            'order' => array('Categories.id' => 'desc'),
            'limit' => 10
        );
        $categories = $this->paginate($this->Categories);
        if(!empty($categories)){

         $categories= $categories->toArray();
            foreach($categories as $key => $category){
               $totol_product = $this->Products->find()->where(['id_category' => $category['id']])->count();
               $categories[$key]['totol_product'] = $totol_product;
            }
        }
        $this->set('categories',$categories);
        $this->set('title_for_layout','category');
        $this->set('menu_active','category');
        
    }

    public function create($id = null){
       $this->viewBuilder()->setLayout('admin');
    
       $this->set('id',$id);

       if(!empty($id)){
            $category = $this->Categories->find()->where(['id' => $id])->first();
            $this->set('category',$category);
       }
       $this->set('menu_active','category');
       //echo WWW_ROOT;
    }

    public function save()
    {   
        $this->autoRender = false;
        $data = $this->request->getData();

        if(empty($data['name'])){
             $this->_jsonError('Vui lòng nhập tên');exit();
        }

        if(empty($data['name_key'])){
             $this->_jsonError('Vui lòng nhập Từ Khóa');exit();
        }

        if(!empty($data['name_key'])){
            $data['name_key'] = $this->vnstring($data['name_key']);
            if(empty($data['id']) || (!empty($data['id']) && $data['old_key'] != $data['name_key'])){
               $check_name_key = $this->Categories->find()->where(['name_key' => $data['name_key']])->first();
               if(!empty($check_name_key)){
                     $this->_jsonError('Từ Khóa đã tồn tại');exit();
               }
            }
        }

        if(empty($data['home'])){
            $data['home'] = 0;
        }

         if(!empty($data['home']) && empty($data['old_img']) && empty($data['photo_main']->getClientFilename())){
            $this->_jsonError('Vui lòng tải ảnh');exit(); 
        }


        $today = date('YmdHi');
        $startDate = date('YmdHi', strtotime('2012-03-14 09:06:00'));
        $range = $today - $startDate;
        $rand = rand(0, $range);
        $name_randome = ($startDate + $rand).'.jpg';
      
        if(!empty($data['photo_main']->getClientFilename())){
            $name_photo       = $data['photo_main']->getClientFilename();             
            $type_photo       = $data['photo_main']->getClientMediaType();                        
            $size_photo       = $data['photo_main']->getSize();                       
            $tmpName_photo    = $data['photo_main']->getStream()->getMetadata('uri');  
            $error_photo      = $data['photo_main']->getError();
            $data['photo'] =  $name_randome;                      
        }      
        
        $categoriesEntity = $this->Categories->newEmptyEntity();
        $categoriesEntity = $this->Categories->patchEntity($categoriesEntity, $data);
        if($this->Categories->save($categoriesEntity)){

            $path = WWW_ROOT.'photos'.DS.'categories';
            if (!file_exists($path)){
                mkdir($path, 0755, true);
            }

            if(!empty($data['photo_main']->getClientFilename())){
                $data['photo_main']->moveTo($path.DS.$name_randome);
                if(!empty( $data['old_img'])){
                    if(file_exists($path . DS . $data['old_img'])){
                        unlink($path . DS . $data['old_img']);
                    }
                }
            }



            $this->Flash->success('Lưu Thành Công');
            $this->_jsonSuccess();exit();

        }

    }

    public function replacename($name = null)
    {
        $this->autoRender = false;
        echo $this->vnstring($name);
    }
    public function delete($id = 0){
        $this->autoRender = false;
        $this->loadModel('Products');
        $check = $this->Products->find()->where(['id_category' => $id])->first();
        if(!empty($check)){
             $this->Flash->error('Vui lòng xóa hết sản phẩm trước khi xóa thể loại này');
        }else{
            $this->Categories->deleteAll(['id' => $id]);
            $this->Flash->success('Xóa Thành Công');
        }
        $this->redirect('/categories/admin');
        
    }
}