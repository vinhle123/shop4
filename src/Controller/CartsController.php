<?php
namespace App\Controller;
class CartsController extends AppController
{   


    public function admin(){
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Orders');
        $this->loadModel('OrderItems');
        $cond = array();
        if($this->request->is('post')){

            if(!empty($this->request->getData('search'))){
                $cond = array(
                   'OR' => array(
                    array('Orders.name like' => '%'.$this->request->getData('search').'%'),
                    array('Orders.email like' => '%'.$this->request->getData('search').'%'),
                    array('Orders.phone like' => '%'.$this->request->getData('search').'%'),
                    array('Orders.code like' => '%'.$this->request->getData('search').'%')
                        
                    ));
            }
          
        }
        $this->paginate = array(
            'conditions' => $cond,
            'order' => array('Orders.id' => 'desc'),
            'limit' => 10
        );
        $orders = $this->paginate($this->Orders);
        $this->set('orders',$orders);
        $this->set('title_for_layout','admin');
        $this->set('menu_active','orders');
    }


    public function status(){
        $this->autoRender = false;
        $this->loadModel('Orders');
        $order_item = $this->request->getData();
        $itemsEntity = $this->Orders->newEmptyEntity();
        $itemsEntity = $this->Orders->patchEntity($itemsEntity, array('id' => $order_item['id'],'status' => $order_item['status']));
        $this->Orders->save($itemsEntity);
        $this->_jsonSuccess();exit;
    }

     public function detail($id=null){
        $this->viewBuilder()->setLayout('admin');
        $this->loadModel('Orders');
        $this->loadModel('OrderItems');

        $order = $this->Orders->find()->where(['id' => $id])->first();
        $items = $this->OrderItems->find()->contain(['Orders','Products'])->where(['order_id' => $id])->all();

        $this->set('order',$order);
        $this->set('items',$items);
        $this->set('title_for_layout','admin');
        $this->set('menu_active','orders');
    }

    public function index()
    { 

        $session = $this->getRequest()->getSession();
        //$session->delete('cart');
        if(empty($session->read('cart'))){
            $session->write('cart', array('product' => array(),'totol_price' => 0,'totol_quality' => 0));
        }

        $carts = $session->read('cart');
        $this->set('carts', $carts);
        $this->render('/element/cart');
    }

    public function cart()
    {
        $session = $this->getRequest()->getSession();
        if(empty($session->read('cart'))){
            $session->write('cart', array('product' => array(),'totol_price' => 0,'totol_quality' => 0));
        }

        if(empty($session->read('code'))){
            $session->write('code', $this->generateRandomString(6));
        }

        $carts = $session->read('cart');
        $this->set('carts', $carts);
        $code = $session->read('code');
        $this->set('code', $code);
       
        $this->set('menu_active','cart');
        $this->set('title_for_layout','Giỏ hàng');
    }

    public function checkout(){
        $this->autoRender = false;
        $session = $this->getRequest()->getSession();
        if(empty($session->read('cart'))){
            $this->_jsonError('Giỏ hàng chưa có sản phẩm nào, vui lòng thêm sản phẩm vào giỏ hàng');exit();
        }else{
            $cart = $session->read('cart');
            if(empty($cart['product'])){
                $this->_jsonError('Giỏ hàng chưa có sản phẩm nào, vui lòng thêm sản phẩm vào giỏ hàng');exit();
            }

        }

        if(empty($this->request->getData())){
            $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();
        }else{
            $this->loadModel('Orders');
            $this->loadModel('OrderItems');
            $data = $this->request->getData();
            if(empty($data['txtphone'])){
                $this->_jsonError('Vui lòng nhập số điện thoại của quý khách hàng');exit();
            }
            if(empty($data['txtname'])){
                $this->_jsonError('Vui lòng nhập họ tên của quý khách hàng');exit();
            }
            if(empty($data['txtemail'])){
               // $this->_jsonError('Vui lòng nhập email của quý khách hàng');exit();
            }
            if(empty($data['txtaddress'])){
                $this->_jsonError('Vui lòng nhập địa chỉ nhận hàng');exit();
            }
            if(empty($data['code'])){
               $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();
            }
            if(empty($data['method'])){
               $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();
            }

            $data_order = array(
                'code' => $data['code'],
                'name' => $data['txtname'],
                'method' => $data['method'],
                'phone' => $data['txtphone'],
                'email' => $data['txtemail'],
                'address' => $data['txtaddress'],
                'note' => $data['txtnote'],
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            );

            $ordersEntity = $this->Orders->newEmptyEntity();
            $ordersEntity = $this->Orders->patchEntity($ordersEntity, $data_order);
            if($this->Orders->save($ordersEntity)){
                $id = $ordersEntity->id;
                foreach($cart['product'] as $product){
                    $order_item = array('order_id' => $id,'product_id' => $product['id'],'price' => $product['price'], 'quality' => $product['quality']);
                    $itemsEntity = $this->OrderItems->newEmptyEntity();
                    $itemsEntity = $this->OrderItems->patchEntity($itemsEntity, $order_item);
                    $this->OrderItems->save($itemsEntity);
                }
                $session->delete('cart');
                $session->delete('code');
                $this->_jsonSuccess();exit;

            }else{
               $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit(); 
            }       
                
        }
        
    }


    public function deleteitemcart(){
        $this->autoRender = false;
        if(!empty($this->request->getData('id'))){
            $data = $this->request->getData();
            $session = $this->getRequest()->getSession();
            if(empty($session->read('cart'))){
                $session->write('cart', array('product' => array(),'totol_price' => 0,'totol_quality' => 0));
            }
            $cart = $session->read('cart');
            if(!empty($cart['product'][$data['id']])){
                unset($cart['product'][$data['id']]);
                $totol_price = 0;
                $totol_quality = 0;
                if(!empty($cart['product'])){
                    foreach($cart['product'] as $product){
                        $totol_price += $product['price']*$product['quality'];
                        $totol_quality += $product['quality'];
                    }

                }
                $cart['totol_price'] = $totol_price;
                $cart['totol_quality'] = $totol_quality;
                $session->write('cart', $cart);
                $response['totol_price'] = number_format($totol_price).' <u itemprop="priceCurrency" content="đ">đ</u>';
                $response['totol_price_default'] = $totol_price;
                $response['result'] = 1;
                $response['num_cart'] = $totol_quality;
                echo json_encode($response);


            }else{
                 $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();
            }


        }else{
            $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();
        }

    }


    public function updatequality(){
        $this->autoRender = false;
        if(!empty($this->request->getData('id')) && !empty($this->request->getData('quality'))){
            $data = $this->request->getData();
            $session = $this->getRequest()->getSession();
            if(empty($session->read('cart'))){
                $session->write('cart', array('product' => array(),'totol_price' => 0,'totol_quality' => 0));
            }
            $cart = $session->read('cart');

            if(!empty($cart['product'][$data['id']])){
                $check_quality = $data['quality'];
                if($check_quality <= 100 && $check_quality > 0){
                    $cart['product'][$data['id']]['quality'] =  $data['quality'];
                    $totol_price = 0;
                    $totol_quality = 0;
                    if(!empty($cart['product'])){
                        foreach($cart['product'] as $product){
                            $totol_price += $product['price']*$product['quality'];
                            $totol_quality += $product['quality'];
                        }

                    }
                    $cart['totol_price'] = $totol_price;
                    $cart['totol_quality'] = $totol_quality;
                    $session->write('cart', $cart);
                    $response['totol_price'] = number_format($totol_price).' <u itemprop="priceCurrency" content="đ">đ</u>';
                    $response['result'] = 1;
                    $response['num_cart'] = $totol_quality;
                    echo json_encode($response);


                }else{
                    $this->_jsonError('Bạn không thể mua quá 100 sản phẩm');exit();
                }
            }else{
                $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();  
            }


        }else{
           $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();  
        }
    }

    public function addproductcart(){
        $this->autoRender = false;
        if(!empty($this->request->getData('id')) && !empty($this->request->getData('price')) && !empty($this->request->getData('name')) && !empty($this->request->getData('img')) && !empty($this->request->getData('quality'))  && $this->request->getData('quality') > 0   ){
            $data = $this->request->getData();
            $session = $this->getRequest()->getSession();
            if(empty($session->read('cart'))){
                $session->write('cart', array('product' => array(),'totol_price' => 0,'totol_quality' => 0));
            }

            $cart = $session->read('cart');
        
            if(empty($cart['product'][$data['id']])){
                $cart['product'][$data['id']] = array('id' => $data['id'],'name' => $data['name'],'name_key' => $data['name_key'],'img' => $data['img'],'price' => $data['price'],'quality' => $data['quality']);
            }else{
                $check_quality = $cart['product'][$data['id']]['quality'] + $data['quality'];
                if($check_quality <= 100 && $check_quality > 0){
                    $cart['product'][$data['id']]['quality'] = $cart['product'][$data['id']]['quality'] + $data['quality'];
                }else{
                    $this->_jsonError('Bạn không thể mua quá 100 sản phẩm');exit();
                }
                
            }
            $totol_price = 0;
            $totol_quality = 0;
            if(!empty($cart['product'])){
                foreach($cart['product'] as $product){
                    $totol_price += $product['price']*$product['quality'];
                    $totol_quality += $product['quality'];
                }

            }
            $cart['totol_price'] = $totol_price;
            $cart['totol_quality'] = $totol_quality;


            $session->write('cart', $cart);

            $response['result'] = 1;
            $response['num_cart'] = $totol_quality;
            echo json_encode($response);

        }else{
           $this->_jsonError('Có lỗi xảy ra vui lòng thử lại');exit();  
        }
         
    }


    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    
}