<?php 

namespace Album\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Mask extends AbstractHelper
{
	
	public function __invoke($mask, $value)
	{
		$len = strlen($mask);
		$format = $mask;
		
		//cont # para substituir o ponto correto
		$cont_hash = 0;
		
		for ($i=0;$i<$len;$i++) {
			if ($mask[$i] != '#') continue;
			
			$format[$i] = substr($value,$cont_hash++,1);
		}
		
		return $format;
	}
	
}

