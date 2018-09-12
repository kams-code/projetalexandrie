<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Declinaison
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\DeclinaisonRepository")
 */
class Declinaison extends Content
{
    
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Produit", inversedBy="declinaisons")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $produit;
	
	
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Attribut", inversedBy="declinaisons")
	* @ORM\JoinColumn(nullable=false)
	*/
	private $attribut;
	
	
	private $nom;
	
	
	/**
     * Constructor
     */
    public function __construct()
    {
		parent::__construct();
		
    }
	
	

    /**
     * Set produit
     *
     * @param \Erico\ApiBundle\Entity\Produit $produit
     *
     * @return Declinaison
     */
    public function setProduit(\Erico\ApiBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Erico\ApiBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set attribut
     *
     * @param \Erico\ApiBundle\Entity\Attribut $attribut
     *
     * @return Declinaison
     */
    public function setAttribut(\Erico\ApiBundle\Entity\Attribut $attribut)
    {
        $this->attribut = $attribut;

        return $this;
    }

    /**
     * Get attribut
     *
     * @return \Erico\ApiBundle\Entity\Attribut
     */
    public function getAttribut()
    {
        return $this->attribut;
    }
	
	public function setNom($chemin)
    {
        $this->chemin = $chemin;

        return $this;
    }

    public function getNom()
    {
		
		$nom = $this->attribut->getDesignation().' - '.$this->getDesignation();
        
		
		return $nom;
		
    }
}
