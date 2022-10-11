<?php

use \Cake\ORM\Entity;

class ExtraPhoto extends Entity{
	protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}