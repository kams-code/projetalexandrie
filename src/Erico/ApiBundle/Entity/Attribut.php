<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attribut
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\AttributRepository")
 */
class Attribut extends Content
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Declinaison",
	mappedBy="produit")
	*/
	private $declinaisons;
	
	
	/**
     * Constructor
     */
    public function __construct()
    {
		parent::__construct();
		
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Attribut
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add declinaison
     *
     * @param \Erico\ApiBundle\Entity\Declinaison $declinaison
     *
     * @return Attribut
     */
    public function addDeclinaison(\Erico\ApiBundle\Entity\Declinaison $declinaison)
    {
        $this->declinaisons[] = $declinaison;

        return $this;
    }

    /**
     * Remove declinaison
     *
     * @param \Erico\ApiBundle\Entity\Declinaison $declinaison
     */
    public function removeDeclinaison(\Erico\ApiBundle\Entity\Declinaison $declinaison)
    {
        $this->declinaisons->removeElement($declinaison);
    }

    /**
     * Get declinaisons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDeclinaisons()
    {
        return $this->declinaisons;
    }
}
