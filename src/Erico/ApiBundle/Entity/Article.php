<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\ArticleRepository")
 */
class Article extends Publication
{
   
  
	/**
	* @ORM\ManyToOne(targetEntity="Erico\ApiBundle\Entity\Categorie")
	* @ORM\JoinColumn(nullable=true)
	*/
	private $categorie;
  
  

    /**
     * Set categorie
     *
     * @param \Erico\ApiBundle\Entity\Categorie $categorie
     *
     * @return Article
     */
    public function setCategorie(\Erico\ApiBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Erico\ApiBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
	
	public function allCategories()
    {
		$temp = array();
		$result = array();
		
		foreach($this->getCategories() as $elem)
		{
			$temp[] = $elem->getId();
			$result[] = $elem;
		}
		
		
		
		if(!in_array($this->categorie->getId(), $temp))
			$result[] = $this->categorie;
		
		
		return $result;
		
    }
	
	
}
