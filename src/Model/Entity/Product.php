<?php

use \Cake\ORM\Entity;

class Product extends Entity{
	protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}