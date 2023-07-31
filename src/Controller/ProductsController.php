<?php
namespace App\Controller;
class ProductsController extends AppController
{   
   
    public function index()
    {  
        $this->set('menu_active','product');
        $this->set('title_for_layout',TITLE_PRODUCT);

        $products = $this->Products->getlist();
        $this->set('products',$products);

         $session = $this->getRequest()->getSession();
        // $session->write('name', array(1=>2,2=>'d')); 
         //pr($session->read('name'));exit;
        //$session->delete('name');
    }

    public function search(){
        //pr( $this->request->getData());
        $products = array();
        $search = '';
        if($this->request->is('post') && !empty($this->request->getData('search'))){
            $search = $this->request->getData('search');
            $products = $this->Products->find()->where(['name like' => '%'.$search.'%'])->all();
           
        }
        $this->set('products',$products);
        $this->set('search',$search);

    }

    public function category($params=null){
        $this->set('menu_active','product');
        $this->set('title_for_layout',TITLE_PRODUCT);
        $this->loadModel('Categories');
        $category = $this->Categories->find()->where(['name_key' => $params])->first();
        if(empty($category)){
            $this->redirect('/error');
        }
        $products = $this->Products->getlistByCategory($category['id']);
        $this->set('products',$products);
        $this->set('category',$category);
    }

    public function detail($params=null)
    {  
        $this->set('menu_active','product');
        $this->set('title_for_layout',TITLE_PRODUCT);

        $product = $this->Products->find()->where(['name_key' => $params])->first();
        if(empty($product)){
            $this->redirect('/error');
        }
        $this->set('product',$product);
        $this->loadModel('ExtraPhotos');
        $photos =  $this->ExtraPhotos->find()->where(['id_product' => $product['id']])->all();
        $this->set('photos',$photos);

        //sp lien quan
        $product_mores = $this->Products->getRandom(4);
        $this->set('product_mores',$product_mores);
    }

    public function admin()
    {   
        $this->_check_login();
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Products');
        //$this->loadModel('Categories');
        // $av = $this->Products->find('all')->all();
        // pr($av);exit;

        $cond = array();

        if($this->request->is('post')){

            if(!empty($this->request->getData('search'))){
                $cond = array('Products.name like' => '%'.$this->request->getData('search').'%');
            }
          
        }

        $this->paginate = array(
            'conditions' => $cond,
            'contain' => array('Categories'),
            'order' => array('Products.id' => 'desc'),
            'limit' => 10
        );
        $products = $this->paginate($this->Products);
        $this->set('products',$products);
        $this->set('title_for_layout','admin');
    }

    public function create($id = null){
       $this->_check_login();
       $this->viewBuilder()->setLayout('admin');
       $this->loadModel('Categories');
       $query = $this->Categories->find('list');
       $categories = $query->toArray();

       $types = array(
        TYPE_BT => 'Thông Thường',
        TYPE_KM => 'Khuyến Mãi',
        TYPE_BANCHAY => 'Bán Chạy'
       );

       $this->set('categories',$categories);
       $this->set('types',$types);
       $this->set('id',$id);

       if(!empty($id)){
            $product = $this->Products->find()->where(['id' => $id])->first();
            $this->set('product',$product);
       }

       $this->loadModel('ExtraPhotos');
       if(!empty($id)){
            $photos =  $this->ExtraPhotos->find()->where(['id_product' => $id])->all()->toArray();
            $this->set('photos',$photos);
       }

       //echo WWW_ROOT;
    }

    public function save()
    {   
        $this->_check_login();
        $this->autoRender = false;
        $data = $this->request->getData();
        if(empty($data['name'])){
             $this->_jsonError('Vui lòng nhập tên sản phẩm');exit();
        }

        if(empty($data['name_key'])){
             $this->_jsonError('Vui lòng nhập Từ Khóa');exit();
        }



        if(!empty($data['name_key'])){
            $data['name_key'] = $this->vnstring($data['name_key']);
            if(empty($data['id']) || (!empty($data['id']) && $data['old_key'] != $data['name_key'])){
               $check_name_key = $this->Products->find()->where(['name_key' => $data['name_key']])->first();
               if(!empty($check_name_key)){
                     $this->_jsonError('Từ Khóa đã tồn tại');exit();
               }
            }
        }

        if(empty($data['id_category'])){
             $this->_jsonError('Vui lòng nhập Thể Loại');exit();
        }

        if(empty($data['unit'])){
             $this->_jsonError('Vui lòng nhập Đơn Vị');exit();
        }

        if(empty($data['price'])){
             $this->_jsonError('Vui lòng nhập Giá');exit();
        }

        if(empty($data['description'])){
             $this->_jsonError('Vui lòng nhập Mô tả');exit();
        }

        

        if(empty($data['id']) &&  empty($data['photo_main']->getClientFilename())){
            $this->_jsonError('Vui lòng tải ảnh chính');exit(); 
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

        $productsEntity = $this->Products->newEmptyEntity();
        $productsEntity = $this->Products->patchEntity($productsEntity, $data);
        $productsEntity->created = date('Y-m-d H:i:s');
        if($this->Products->save($productsEntity)){

           
            $id = $productsEntity->id;

           
            $path = WWW_ROOT.'photos'.DS.$id;
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

            $this->loadModel('ExtraPhotos');

            if($data['photo_extras'][0]->getClientFilename()){
                $key = 0;
                foreach($data['photo_extras'] as $extras){
                    $key = $key + 1;
                    if(!empty($extras->getClientFilename())){
                        $name_pt = $id.'_'.$key.$this->randomPassword(5).$name_randome;
                        $photo_ex = array('id_product' => $productsEntity->id,'image' => $name_pt);
                        $photosEntity = $this->ExtraPhotos->newEmptyEntity();
                        $photosEntity = $this->ExtraPhotos->patchEntity($photosEntity, $photo_ex);
                        if($this->ExtraPhotos->save($photosEntity)){
                            $extras->moveTo($path.DS.$name_pt);
                        }
                    }
                }

            }

            // remove old img extra
            if(!empty($data['images_remove'])){
                $old_imgs = explode(" ",$data['images_remove']);
                foreach($old_imgs as $old_img){
                    $this->ExtraPhotos->deleteAll(['image' => $old_img]);
                    if(file_exists($path . DS . $old_img)){
                        unlink($path . DS . $old_img);
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
        echo $this->vnstring(trim($name));
    }

    public function delete($id = 0){
        $this->_check_login();
        $this->autoRender = false;
        $path = WWW_ROOT.'photos'.DS.$id;
        if(file_exists($path)){
            array_map('unlink', glob("$path/*.*"));
            rmdir($path);
        }

        $this->loadModel('ExtraPhotos');
        $this->ExtraPhotos->deleteAll(['id_product' => $id]);
        $this->Products->deleteAll(['id' => $id]);
        $this->Flash->success('Xóa Thành Công');
        $this->redirect('/admin');
        
    }
}