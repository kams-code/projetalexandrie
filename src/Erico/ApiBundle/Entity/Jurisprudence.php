<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jurisprudence
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\JurisprudenceRepository")
 */
class Jurisprudence extends Loi
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_tribunal", type="string", length=255)
     */
    private $nomTribunal;

    /**
     * @var string
     *
     * @ORM\Column(name="section_tribunal", type="string", length=255)
     */
    private $sectionTribunal;

    /**
     * @var string
     *
     * @ORM\Column(name="sommaire", type="text", nullable=true)
     */
    private $sommaire;
	
	
	/**
	* @ORM\ManyToMany(targetEntity="Erico\ApiBundle\Entity\Paragraphe",
	cascade={"persist"})
	*/
	private $textes;
	
	/**
     * @var string
     *
     * @ORM\Column(name="decision_attaque", type="string", length=255)
     */
	private $decision_attaque;
	
	
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Nature")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $nature;
	
	
	public function __construct()
	{
		
		parent::__construct();
		
		$this->nature = 0;
	}
	
	
    
    /**
     * Set nomTribunal
     *
     * @param string $nomTribunal
     *
     * @return Jurisprudence
     */
    public function setNomTribunal($nomTribunal)
    {
        $this->nomTribunal = $nomTribunal;

        return $this;
    }

    /**
     * Get nomTribunal
     *
     * @return string
     */
    public function getNomTribunal()
    {
        return $this->nomTribunal;
    }

    /**
     * Set sectionTribunal
     *
     * @param string $sectionTribunal
     *
     * @return Jurisprudence
     */
    public function setSectionTribunal($sectionTribunal)
    {
        $this->sectionTribunal = $sectionTribunal;

        return $this;
    }

    /**
     * Get sectionTribunal
     *
     * @return string
     */
    public function getSectionTribunal()
    {
        return $this->sectionTribunal;
    }

    /**
     * Set sommaire
     *
     * @param string $sommaire
     *
     * @return Jurisprudence
     */
    public function setSommaire($sommaire)
    {
        $this->sommaire = $sommaire;

        return $this;
    }

    /**
     * Get sommaire
     *
     * @return string
     */
    public function getSommaire()
    {
        return $this->sommaire;
    }

    
    

    /**
     * Add texte
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $texte
     *
     * @return Jurisprudence
     */
    public function addTexte(\Erico\ApiBundle\Entity\Paragraphe $texte)
    {
        $this->textes[] = $texte;

        return $this;
    }

    /**
     * Remove texte
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $texte
     */
    public function removeTexte(\Erico\ApiBundle\Entity\Paragraphe $texte)
    {
        $this->textes->removeElement($texte);
    }

    /**
     * Get textes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextes()
    {
        return $this->textes;
    }

   

    /**
     * Set decisionAttaque
     *
     * @param string $decisionAttaque
     *
     * @return Jurisprudence
     */
    public function setDecisionAttaque($decisionAttaque)
    {
        $this->decision_attaque = $decisionAttaque;

        return $this;
    }

    /**
     * Get decisionAttaque
     *
     * @return string
     */
    public function getDecisionAttaque()
    {
        return $this->decision_attaque;
    }

    /**
     * Set nature
     *
     * @param \Erico\ApiBundle\Entity\Nature $nature
     *
     * @return Jurisprudence
     */
    public function setNature(\Erico\ApiBundle\Entity\Nature $nature = null)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     * Get nature
     *
     * @return \Erico\ApiBundle\Entity\Nature
     */
    public function getNature()
    {
        return $this->nature;
    }
}
