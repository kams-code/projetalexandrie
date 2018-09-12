<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Content;

/**
 * Paragraphe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\ParagrapheRepository")
 */
 
 
class Paragraphe extends Content
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Texte", inversedBy="paragraphes")
	* @ORM\JoinColumn(nullable=false)
	*/
	private $texte;
	
	
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Paragraphe", inversedBy="fils")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $parent;
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Paragraphe",
	mappedBy="parent")
	*/
	private $fils; 
	
	/**
     * @var integer
     *
     * @ORM\Column(name="ordre", type="integer")
     */
    private $ordre;
	
	private $designationTexte;
	
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="is_article", type="boolean")
     */
    private $is_article;

	public function __construct()
	{
		parent::__construct();
		$this->ordre = 0;
	}
	
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Paragraphe
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
     * Set texte
     *
     * @param \Erico\ApiBundle\Entity\Texte $texte
     *
     * @return Paragraphe
     */
    public function setTexte(\Erico\ApiBundle\Entity\Texte $texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return \Erico\ApiBundle\Entity\Texte
     */
    public function getTexte()
    {
        return $this->texte;
    }
	

    /**
     * Set parent
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $parent
     *
     * @return Paragraphe
     */
    public function setParent(\Erico\ApiBundle\Entity\Paragraphe $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Erico\ApiBundle\Entity\Paragraphe
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add fil
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $fil
     *
     * @return Paragraphe
     */
    public function addFil(\Erico\ApiBundle\Entity\Paragraphe $fil)
    {
        $this->fils[] = $fil;

        return $this;
    }

    /**
     * Remove fil
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $fil
     */
    public function removeFil(\Erico\ApiBundle\Entity\Paragraphe $fil)
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

    /**
     * Set ordre
     *
     * @param integer $ordre
     *
     * @return Paragraphe
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
    }
	
	public function setDesignationTexte($designationTexte)
    {
        $this->designationTexte = $designationTexte;

        return $this;
    }

    
    public function getDesignationTexte()
    {
        return $this->getDesignation().' ( '.$this->texte->getDesignation().' ) ';
    }

    /**
     * Set isArticle
     *
     * @param boolean $isArticle
     *
     * @return Paragraphe
     */
    public function setIsArticle($isArticle)
    {
        $this->is_article = $isArticle;

        return $this;
    }

    /**
     * Get isArticle
     *
     * @return boolean
     */
    public function getIsArticle()
    {
        return $this->is_article;
    }
}
