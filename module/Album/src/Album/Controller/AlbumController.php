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
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
		
		$album = $this->getServiceLocator()->get('Album\Model\Album');
		$album->loadEntityById($id);
		
        $form = new AlbumForm();
        $form->bind($album->getEntity());
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $album->persist($form->getData()->getArrayCopy());
                return $this->redirect()->toRoute('album');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }
		$album = $this->getServiceLocator()->get('Album\Model\Album');
		
		$album->loadEntityById($id);
		$album->remove();
		
		return $this->redirect()->toRoute('album');
    }	
}