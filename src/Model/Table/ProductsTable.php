<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;


class ProductsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('products');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Categories',[
        	'foreignKey' => 'id_category'
        ]);
    }

    public function getlisthome(){
        $products = $this->find()->where(['type <>' => 0])->limit(6)->all()->toArray();
        if(!empty($products)){
            $products = $this->getItems($products);
        }
        return $products;
    }

    public function getlistByCategory($id){
        $products = $this->find()->where(['id_category' => $id])->all()->toArray();
        if(!empty($products)){
            $products = $this->getItems($products);
        }
        return $products;
    }

    public function getlist(){
        $products = $this->find()->all()->toArray();
        if(!empty($products)){
            $products = $this->getItems($products);
        }
        return $products;
    }

    public function getRandom($number = 1){
        $products = $this->find()->order('rand()')->limit($number)->all()->toArray();
        if(!empty($products)){
            $products = $this->getItems($products);
        }
        return $products;
    }

    public function getItems($items){
        $ExtraPhotos_model =  TableRegistry::get('ExtraPhotos');
        foreach($items as $key => $item){
            $photos =  $ExtraPhotos_model->find()->where(['id_product' => $item['id']])->all()->toArray();
            if(!empty($photos)){
                $items[$key]['photos'] =  $photos;  
            }
        }
        return $items;
    }

    public function getlisthomeRandom(){
        $products = $this->find()->order('rand()')->limit(10)->all()->toArray();
        return $products;
    }
}