<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Publication;

/**
 * Texte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\TexteRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"texte"="Texte", "loi"="Erico\ApiBundle\Entity\Loi", "document"="Erico\ApiBundle\Entity\Document", "doctrine"="Erico\ApiBundle\Entity\Doctrine"})
 */
 
class Texte extends Publication
{
    
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Paragraphe",
	mappedBy="texte")
	*/
	private $paragraphes; // Ici paragraphes prend un « s », car un texte a plusieurs paragraphes !
	
	private $jsonParagraphes;
	
	
	
	public function __construct()
	{
		parent::__construct();

	}
    

    /**
     * Add paragraphe
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $paragraphe
     *
     * @return Texte
     */
    public function addParagraphe(\Erico\ApiBundle\Entity\Paragraphe $paragraphe)
    {
        $this->paragraphes[] = $paragraphe;
		$paragraphes->setTexte($this); // On ajoute ceci
        return $this;
    }

    /**
     * Remove paragraphe
     *
     * @param \Erico\ApiBundle\Entity\Paragraphe $paragraphe
     */
    public function removeParagraphe(\Erico\ApiBundle\Entity\Paragraphe $paragraphe)
    {
        $this->paragraphes->removeElement($paragraphe);
    }

    /**
     * Get paragraphes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParagraphes()
    {
        return $this->paragraphes;
    }
	
	public function setJsonParagraphes($jsonParagraphes)
    {
		$this->jsonParagraphes = $jsonParagraphes;
		
        return $this;
    }
	
	public function getJsonParagraphes()
    {
		
        return $this->jsonParagraphes;
		
    }
	
}
