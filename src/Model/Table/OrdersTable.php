<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class OrdersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('orders');
    }

}