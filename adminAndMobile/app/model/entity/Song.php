<?php
 
namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities;
use Nette\Utils\Strings;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 */
class Song extends Entities\BaseEntity
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="uuid")
	 * @ORM\GeneratedValue(strategy="NONE")
	 * @var \Ramsey\Uuid\Uuid
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 * @var string
	 */
	private $name;

	/**
	 * @ORM\ManyToOne(targetEntity="Genre", inversedBy="songs")
	 * @ORM\JoinColumn(referencedColumnName="name")
	 * @var Genre
	 */
	private $genre;

    public function __construct($name, Genre $genre = null)
    {
	    $this->id = Uuid::uuid4();
    	$this->name = $name;
	    $this->genre = $genre;
    }

	public function getId() : string
	{
		return $this->id->toString();
	}

	public function getAlphaNumericId() : string
	{
		return Strings::replace($this->getId(), '~-~', '_');
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function getGenre() : Genre
	{
		return $this->genre;
	}
    
}

