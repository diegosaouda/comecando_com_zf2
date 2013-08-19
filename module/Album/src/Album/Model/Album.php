<?php

namespace Album\Model;

use Doctrine\ORM\EntityManager;

use Album\Entity\Album as AlbumEntity;

class Album
{
	
	/**
	 * @var Doctrine\ORM\EntityManager
	 */
	private $em;
	
	/**
	 * @var Album\Entity\Album
	 */
	private $albumEntity;
	
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
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
}