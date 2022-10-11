<?php
namespace App\View\Helper;

use Cake\View\Helper;

class coreHelper extends Helper
{
	public function price($number=0){
		if(empty($number)){
			$number = 0;
		}
		$price =  number_format($number);
		return $price;
	}
}