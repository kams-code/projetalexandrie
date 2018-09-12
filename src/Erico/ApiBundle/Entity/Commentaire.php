<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\CommentaireRepository")
 */
class Commentaire extends Content
{
    
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


	/**
     * @var boolean
     *
     * @ORM\Column(name="approuver", type="boolean")
     */
    private $approuver;

	
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Publication", inversedBy="commentaires")
	* @ORM\JoinColumn(nullable=false)
	*/
	private $publication;
	
	
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Commentaire", inversedBy="fils")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $parent;
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Commentaire",
	mappedBy="parent")
	*/
	private $fils; 
	
	
	public function __construct()
    {
		parent::__construct();
		
		$this->approuver = false;
		
    }
	
    
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Commentaire
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
     * Set approuver
     *
     * @param boolean $approuver
     *
     * @return Commentaire
     */
    public function setApprouver($approuver)
    {
        $this->approuver = $approuver;
		
		//lorsqu'on approuve un commentaire on approuve aussi son parent
		if($approuver and $this->getParent()!= null)
		{
			
			$this->getParent()->setApprouver(true);
			
		}
		else
		{
			//lorsqu'on desapprouve un commentaire on desapprouve aussi ses fils
			if(!$approuver)
			{
				foreach($this->getFils() as $elem){
				
					$elem->setApprouver($approuver);
					
				
				}
			}
			
		}
		

        return $this;
    }

    /**
     * Get approuver
     *
     * @return boolean
     */
    public function getApprouver()
    {
        return $this->approuver;
    }
	

    /**
     * Set publication
     *
     * @param \Erico\ApiBundle\Entity\Publication $publication
     *
     * @return Commentaire
     */
    public function setPublication(\Erico\ApiBundle\Entity\Publication $publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \Erico\ApiBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set parent
     *
     * @param \Erico\ApiBundle\Entity\Commentaire $parent
     *
     * @return Commentaire
     */
    public function setParent(\Erico\ApiBundle\Entity\Commentaire $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Erico\ApiBundle\Entity\Commentaire
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add fil
     *
     * @param \Erico\ApiBundle\Entity\Commentaire $fil
     *
     * @return Commentaire
     */
    public function addFil(\Erico\ApiBundle\Entity\Commentaire $fil)
    {
        $this->fils[] = $fil;

        return $this;
    }

    /**
     * Remove fil
     *
     * @param \Erico\ApiBundle\Entity\Commentaire $fil
     */
    public function removeFil(\Erico\ApiBundle\Entity\Commentaire $fil)
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
