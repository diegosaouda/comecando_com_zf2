<?php
namespace Album;

class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Album\Model\Album' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $album = new \Album\Model\Album($em);
                    return $album;
                }
            ),
        );
    }
	
	public function getViewHelperConfig() 
	{
		return array(
			'factories' => array(
				
				'formatDate' => function($sm) {
					//en_US
					//de-DE
					//fr_FR
					//pt_BR
					
					\Locale::setDefault('pt_BR');
					
					$locale = \Locale::getDefault();
					
					return new View\Helper\FormatDate($locale);
                },
				
			),
			'invokables' => array(
				'formatCPF'  => new View\Helper\FormatCPF(),
				'showStatus' => new View\Helper\ShowStatus(),
				'mask' => new View\Helper\Mask()
			),
		);
	}
	
}