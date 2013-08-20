<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Album\Form\AlbumForm;

class AlbumController extends AbstractActionController
{
    public function indexAction()
    {
		$album = $this->getServiceLocator()->get('Album\Model\Album');
        return new ViewModel(array(
            'albums' => $album->fetchAll()
        ));
    }

    public function addAction()
    {
        $form = new AlbumForm();
		
        $request = $this->getRequest();
        if ($request->isPost()) {
            $album = $this->getServiceLocator()->get('Album\Model\Album');
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->persist($form->getData());
				
				//redirecionando...
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }	
}