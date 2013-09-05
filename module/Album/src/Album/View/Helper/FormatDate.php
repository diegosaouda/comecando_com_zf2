<?php 

namespace Album\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FormatDate extends AbstractHelper
{

	private $locale;
	
	public function __construct($locale)
	{
		$this->locale;
	}
	
	public function __invoke(\DateTime $dateTime)
	{
		$dateFormat = new \IntlDateFormatter($this->locale,\IntlDateFormatter::FULL, \IntlDateFormatter::NONE, 'America/Sao_Paulo');
		return $dateFormat->format($dateTime);
	}
	
}

