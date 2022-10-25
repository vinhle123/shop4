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

    
}