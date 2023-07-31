<?php
namespace App\Controller;
use Cake\Routing\Router;
class BlogsController extends AppController
{   
   
    public function index()
    {  
        $this->set('menu_active','blog');
        $this->set('title_for_layout',TITLE_BLOG);

        $blogs = $this->Blogs->getlist();
        $this->set('blogs',$blogs);
        $session = $this->getRequest()->getSession();
       
    }

    public function category($params=null){
        $this->set('menu_active','blog');
        $this->set('title_for_layout',TITLE_BLOG);
        $this->loadModel('Categories');
        $category = $this->Categories->find()->where(['title_key' => $params])->first();
        if(empty($category)){
            $this->redirect('/error');
        }
        $blogs = $this->Blogs->getlistByCategory($category['id']);
        $this->set('blogs',$blogs);
        $this->set('category',$category);
    }

    public function detail($params=null)
    {  
        $this->set('menu_active','blog');
        $this->set('title_for_layout',TITLE_BLOG);

        $blog = $this->Blogs->find()->where(['title_key' => $params])->first();
        if(empty($blog)){
            $this->redirect('/error');
        }
        $this->set('blog',$blog);
        //sp lien quan
        $this->loadModel('Products');
        $product_mores = $this->Products->getRandom(10);
        $this->set('product_mores',$product_mores);
    }

    public function admin()
    {   
        $this->_check_login();
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Blogs');
        //$this->loadModel('Categories');
        // $av = $this->Blogs->find('all')->all();
        // pr($av);exit;

        $cond = array();

        if($this->request->is('post')){

            if(!empty($this->request->getData('search'))){
                $cond = array('Blogs.title like' => '%'.$this->request->getData('search').'%');
            }
          
        }

        $this->paginate = array(
            'conditions' => $cond,
            // 'contain' => array('Categories'),
            'order' => array('Blogs.id' => 'desc'),
            'limit' => 10
        );
        $blogs = $this->paginate($this->Blogs);
        $this->set('blogs',$blogs);
        $this->set('menu_active','blogs');
        $this->set('title_for_layout','blogs');
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
            $blog = $this->Blogs->find()->where(['id' => $id])->first();
            $this->set('blog',$blog);
       }
      
       $this->set('menu_active','blogs');
        $this->set('title_for_layout','blogs');
       //echo WWW_ROOT;
    }

    public function upload(){
        $this->autoRender = false;
        $path = WWW_ROOT.'photos'.DS.'blogs';
        if (!file_exists($path)){
            mkdir($path, 0755, true);
        }

        $imageFolder = "photos/blogs/";
        reset ($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])){
            if (isset($_SERVER['HTTP_ORIGIN'])) {
             header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            
            }
              if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }
            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            $link = Router::url('/', true).'webroot/'.$filetowrite;
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            echo json_encode(array('location' => $link));
        } else {
            header("HTTP/1.1 500 Server Error");
        }

        
    }

    public function save()
    {   
        $this->_check_login();
        $this->autoRender = false;
        $data = $this->request->getData();
        if(empty($data['title'])){
             $this->_jsonError('Vui lòng nhập tiêu đề');exit();
        }

        if(empty($data['title_key'])){
             $this->_jsonError('Vui lòng nhập Từ Khóa');exit();
        }



        if(!empty($data['title_key'])){
            $data['title_key'] = $this->vnstring($data['title_key']);
            if(empty($data['id']) || (!empty($data['id']) && $data['old_key'] != $data['title_key'])){
               $check_title_key = $this->Blogs->find()->where(['title_key' => $data['title_key']])->first();
               if(!empty($check_title_key)){
                     $this->_jsonError('Từ Khóa đã tồn tại');exit();
               }
            }
        }

        if(empty($data['description'])){
             $this->_jsonError('Vui lòng nhập Nội dung');exit();
        }

        if(empty($data['id']) && empty($data['photo_main']->getClientFilename())){
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

        $blogsEntity = $this->Blogs->newEmptyEntity();
        $blogsEntity = $this->Blogs->patchEntity($blogsEntity, $data);
        $blogsEntity->created = date('Y-m-d H:i:s');
        if($this->Blogs->save($blogsEntity)){
            $id = $blogsEntity->id;
            $path = WWW_ROOT.'photos'.DS.'blogs'.DS.$id;
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

    public function delete($id = 0){
        $this->_check_login();
        $this->autoRender = false;
        $path = WWW_ROOT.'photos'.DS.'blogs'.DS.$id;
        if(file_exists($path)){
            array_map('unlink', glob("$path/*.*"));
            rmdir($path);
        }
        $this->Blogs->deleteAll(['id' => $id]);
        $this->Flash->success('Xóa Thành Công');
        $this->redirect('/blogs/admin');
        
    }
}