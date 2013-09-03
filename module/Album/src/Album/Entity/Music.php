<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="album_music")
 * @ORM\Entity
 */
class Music
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
	 * @ORM\ManyToOne(targetEntity="Album", inversedBy="musics")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
	 * @var Album
	 */
	private $album;
	
	/**
	 * @ORM\Column(type="string")
	 * 
	 * @var string
	 */
	private $name;
	
	
	public function getId()
	{
		return $this->id;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setAlbum($album)
	{
		$this->album = $album;
	}
	
	public function getAlbum()
	{
		return $this->album;
	}
	
}
