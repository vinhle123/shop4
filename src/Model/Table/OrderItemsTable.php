<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class OrderItemsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('order_items');
        $this->belongsTo('Orders',[
            'foreignKey' => 'order_id'
        ]);
        $this->belongsTo('Products',[
            'foreignKey' => 'product_id'
        ]);
    }

}