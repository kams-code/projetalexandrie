<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Loi;

/**
 * TexteLoi
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\TexteLoiRepository")
 */
class TexteLoi extends Loi
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="lieu_adoption", type="string", length=255, nullable=true)
     */
    private $lieuAdoption;


    public function __construct()
	{
		parent::__construct();

	}
	
    /**
     * Set lieuAdoption
     *
     * @param string $lieuAdoption
     *
     * @return TexteLoi
     */
    public function setLieuAdoption($lieuAdoption)
    {
        $this->lieuAdoption = $lieuAdoption;

        return $this;
    }

    /**
     * Get lieuAdoption
     *
     * @return string
     */
    public function getLieuAdoption()
    {
        return $this->lieuAdoption;
    }
	
}

