<?php
namespace App\View\Helper;

use Cake\View\Helper;

class webrootHelper extends Helper
{

	public function scriptBlock($script, $options = array()) {
		$options += array('type' => 'text/javascript', 'safe' => true, 'inline' => true);
		if ($options['safe']) {
			$script = "\n" . '//<![CDATA[' . "\n" . $script . "\n" . '//]]>' . "\n";
		}
		if (!$options['inline'] && empty($options['block'])) {
			$options['block'] = 'script';
		}
		unset($options['inline'], $options['safe']);

		$attributes = $this->_parseAttributes($options, array('block'));
		$out = sprintf($this->_tags['javascriptblock'], $attributes, $script);

		if (empty($options['block'])) {
			return $out;
		}
		$this->_View->append($options['block'], $out);
	}

}