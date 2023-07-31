<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;


class BlogsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('blogs');
        $this->addBehavior('Timestamp');
        // $this->belongsTo('Categories',[
        // 	'foreignKey' => 'id_category'
        // ]);
    }

    public function getlisthome(){
        $blogs = $this->find()->where(['type <>' => 0])->limit(6)->all()->toArray();
        if(!empty($blogs)){
            $blogs = $this->getItems($blogs);
        }
        return $blogs;
    }

    public function getlistByCategory($id){
        $blogs = $this->find()->where(['id_category' => $id])->all()->toArray();
        if(!empty($blogs)){
            $blogs = $this->getItems($blogs);
        }
        return $blogs;
    }

    public function getlist(){
        $blogs = $this->find()->all()->toArray();
        if(!empty($blogs)){
            $blogs = $this->getItems($blogs);
        }
        return $blogs;
    }

    public function getRandom($number = 1){
        $blogs = $this->find()->order('rand()')->limit($number)->all()->toArray();
        if(!empty($blogs)){
            $blogs = $this->getItems($blogs);
        }
        return $blogs;
    }

    public function getItems($items){
        return $items;
    }

    public function getlisthomeRandom(){
        $blogs = $this->find()->order('rand()')->limit(10)->all()->toArray();
        return $blogs;
    }
}