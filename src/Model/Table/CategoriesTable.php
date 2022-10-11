<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class CategoriesTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('categories');
    }

    public function getlisthome(){
        return $categories = $this->find()->where(['home' => 1])->all()->toArray();

    }

    public function getlistLayot($value='')
    {
        return $categories = $this->find()->all()->toArray();
    }

}