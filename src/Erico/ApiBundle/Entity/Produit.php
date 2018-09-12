<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\ProduitRepository")
 */
class Produit extends Publication
{
    
    /**
     * @var float
     *
     * @ORM\Column(name="tarifRegulier", type="float", nullable=true)
     */
    private $tarifRegulier;

    /**
     * @var string
     *
     * @ORM\Column(name="unite", type="string", length=255, nullable=true)
     */
    private $unite;
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Declinaison",
	mappedBy="produit")
	*/
    private $declinaisons;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=true)
     */
    private $fichier;
	
	
	
	/**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->tarifRegulier = 0;
		
    }

    /**
     * Set tarifRegulier
     *
     * @param float $tarifRegulier
     *
     * @return Produit
     */
    public function setTarifRegulier($tarifRegulier)
    {
        $this->tarifRegulier = $tarifRegulier;

        return $this;
    }

    /**
     * Get tarifRegulier
     *
     * @return float
     */
    public function getTarifRegulier()
    {
        return $this->tarifRegulier;
    }

    /**
     * Set unite
     *
     * @param string $unite
     *
     * @return Produit
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;

        return $this;
    }

    /**
     * Get unite
     *
     * @return string
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Add declinaison
     *
     * @param \Erico\ApiBundle\Entity\Declinaison $declinaison
     *
     * @return Produit
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

    

    /**
     * Set fichier
     *
     * @param string $fichier
     *
     * @return Produit
     */
    public function setFichier($fichier)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return string
     */
    public function getFichier()
    {
        return $this->fichier;
    }
}
