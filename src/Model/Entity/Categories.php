<?php

use \Cake\ORM\Entity;

class Categories extends Entity{
	protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}