<?php 

namespace Album\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ShowStatus extends AbstractHelper
{
	
	public function __invoke($status)
	{
		$bool = (bool) $status;
		return $bool ? 'Ativo' : 'Inativo';
	}
	
}

