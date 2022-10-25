<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class ContactTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('contact');
    }

}