<?php

namespace Album\Model;

use Album\Entity\Album as AlbumEntity;

use Doctrine\ORM\EntityManager;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Album implements InputFilterAwareInterface
{
	
	/**
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;
	
	/**
	 * @var Album\Entity\Album
	 */
	private $albumEntity;
	
	/**
	 * @var InputFilterInterface
	 */
	private $inputFilter;
	
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * Retorna a entidade álbum
	 * @return Album\Entity\Album
	 */
	public function getEntity()
	{
		return $this->albumEntity;
	}
	
	/**
	 * Retorna todos os albuns
	 * @param array Lista de Albuns
	 */
	public function fetchAll()
	{
		$repository = $this->em->getRepository('Album\Entity\Album');
		$album_list = $repository->findAll();
		
		return $album_list;
	}
	
	/**
	 * Carrega o album pelo id
	 */
	public function loadEntityById($id)
	{
		$this->albumEntity = $this->em->find('Album\Entity\Album', $id);
	}
	
	/**
	 * Salva um album: Insere ou Atualiza
	 * @param array $data
	 * @return int id
	 */
	public function persist(array $data)
	{
		if (!$this->albumEntity) {
			$this->albumEntity = new AlbumEntity();
		}
		
		$this->albumEntity->exchangeArray($data);
			
		//id está setado ?
		if (!$this->albumEntity->getId()) {
			//inserir
			$this->em->persist($this->albumEntity);
		} else {
			//atualizar
			$this->em->merge($this->albumEntity);
		}
		
		//realiza acao no banco
		$this->em->flush();
		
		return $this->albumEntity->getId();
	}
	
	/**
	 * Remove o album carregado
	 * @return bool
	 */
	public function remove()
	{
		if (!$this->albumEntity) {
			throw new \Exception('Entidade não carregada, utilize método loadEntityById');
		}
		
		$this->em->remove($this->albumEntity);
		$this->em->flush();
		
		//foi removido?
		return is_null($this->albumEntity->getId()) ? true : false; 
	}
	
	
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Não Usado");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'artist',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
	
}