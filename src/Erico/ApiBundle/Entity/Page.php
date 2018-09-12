<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\PageRepository")
 */
class Page extends Publication
{
    
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Page", inversedBy="fils")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $parent;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Page",
	mappedBy="parent")
	*/
	private $fils; 
    

    /**
     * Set parent
     *
     * @param \Erico\ApiBundle\Entity\Page $parent
     *
     * @return Page
     */
    public function setParent(\Erico\ApiBundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Erico\ApiBundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add fil
     *
     * @param \Erico\ApiBundle\Entity\Page $fil
     *
     * @return Page
     */
    public function addFil(\Erico\ApiBundle\Entity\Page $fil)
    {
        $this->fils[] = $fil;

        return $this;
    }

    /**
     * Remove fil
     *
     * @param \Erico\ApiBundle\Entity\Page $fil
     */
    public function removeFil(\Erico\ApiBundle\Entity\Page $fil)
    {
        $this->fils->removeElement($fil);
    }

    /**
     * Get fils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFils()
    {
        return $this->fils;
    }
}
