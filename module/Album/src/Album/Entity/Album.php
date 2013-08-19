<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Album\Entity\Repository\Album")
 */
class Album
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 * 
	 * @var int
	 */
	private $id;
	
	/**
	 * @ORM\Column(type="string")
	 * 
	 * @var string
	 */
	private $artist;
	
	/**
	 * @ORM\Column(type="string")
	 * 
	 * @var string
	 */
	private $title;
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setArtist($artist)
	{
		$this->artist = $artist;
	}
	
	public function getArtist()
	{
		return $this->artist;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Preenche a entidade com valor passado via array
	 * @param array $data Entidade no formato array (Geralmente Valor vindo do form)
	 */
	public function exchangeArray(array $data)
	{
		$this->id = isset($data['id']) ? $data['id'] : null;
		$this->artist = isset($data['artist']) ? $data['artist'] : null;
		$this->title = isset($data['title']) ? $data['title'] : null;
	}
}