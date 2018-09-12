<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Erico\ApiBundle\Entity\Content;

/**
 * Publication
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\PublicationRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"publication"="Publication", "texte"="Erico\ApiBundle\Entity\Texte", "article"="Erico\ApiBundle\Entity\Article", "page"="Erico\ApiBundle\Entity\Page"})
 */
 
class Publication extends Content
{
    

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_intro", type="string", length=255, nullable=true)
     */
    private $imageIntro;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_vue", type="integer")
     */
    private $nbrVue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publier", type="boolean")
     */
    private $publier;
	
	
	/**
	* @ORM\ManyToMany(targetEntity="Erico\ApiBundle\Entity\Categorie",  cascade={"persist", "remove"})
	*/
	  private $categories;
	  
	/**
	* @ORM\ManyToMany(targetEntity="Erico\ApiBundle\Entity\Keyword",
	cascade={"persist"})
	*/
	  private $keywords;
	  
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publish", type="datetime")
     */
    private $datePublish;
	
	
	/**
	* @ORM\OneToMany(targetEntity="Erico\ApiBundle\Entity\Commentaire",
	mappedBy="publication")
	*/
	private $commentaires; 
	

	/**
     * Constructor
     */
    public function __construct()
    {
		parent::__construct();
		
		$this->nbrVue = 0;
		$this->publier = false;
		$this->datePublish = new \DateTime();
    }
	
    
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publication
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
     * Set imageIntro
     *
     * @param string $imageIntro
     *
     * @return Publication
     */
    public function setImageIntro($imageIntro)
    {
        $this->imageIntro = $imageIntro;

        return $this;
    }

    /**
     * Get imageIntro
     *
     * @return string
     */
    public function getImageIntro()
    {	
		if($this->imageIntro != null)
			return $this->imageIntro;
		else
			return '/bundles/ericobackend/images/thumbnail-default.jpg';
    }

    /**
     * Set nbrVue
     *
     * @param integer $nbrVue
     *
     * @return Publication
     */
    public function setNbrVue($nbrVue)
    {
        $this->nbrVue = $nbrVue;

        return $this;
    }

    /**
     * Get nbrVue
     *
     * @return integer
     */
    public function getNbrVue()
    {
        return $this->nbrVue;
    }

    /**
     * Set publier
     *
     * @param boolean $publier
     *
     * @return Publication
     */
    public function setPublier($publier)
    {
        $this->publier = $publier;

        return $this;
    }

    /**
     * Get publier
     *
     * @return boolean
     */
    public function getPublier()
    {
        return $this->publier;
    }

    /**
     * Add category
     *
     * @param \Erico\ApiBundle\Entity\Categorie $category
     *
     * @return Publication
     */
    public function addCategory(\Erico\ApiBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Erico\ApiBundle\Entity\Categorie $category
     */
    public function removeCategory(\Erico\ApiBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        $result = array();
		
		$tail = count($this->categories)-1;
		
		for($i=$tail; $i >=0; $i--)
		{
			if( !$this->categories[$i]->getArchiver()  ){
			
				$result[] = $this->categories[$i];
				
			}
			
		}
		
		return $result;
		
		//return $this->categories;
    }

    /**
     * Add keyword
     *
     * @param \Erico\ApiBundle\Entity\Keyword $keyword
     *
     * @return Publication
     */
    public function addKeyword(\Erico\ApiBundle\Entity\Keyword $keyword)
    {
        $this->keywords[] = $keyword;

        return $this;
    }

    /**
     * Remove keyword
     *
     * @param \Erico\ApiBundle\Entity\Keyword $keyword
     */
    public function removeKeyword(\Erico\ApiBundle\Entity\Keyword $keyword)
    {
        $this->keywords->removeElement($keyword);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getKeywords()
    {
        $result = array();
		
		$tail = count($this->keywords)-1;
		
		for($i=$tail; $i >=0; $i--)
		{
			if( !$this->keywords[$i]->getArchiver()  ){
			
				$result[] = $this->keywords[$i];
				
			}
			
		}
		
		return $result;
		
		//return $this->keywords;
    }
	

    /**
     * Set datePublish
     *
     * @param \DateTime $datePublish
     *
     * @return Publication
     */
    public function setDatePublish($datePublish)
    {
        $this->datePublish = $datePublish;

        return $this;
    }

    /**
     * Get datePublish
     *
     * @return \DateTime
     */
    public function getDatePublish()
    {
        return $this->datePublish;
    }
	
	public function monthDatePublish()
    {
        
		
		$d = $this->datePublish;	
		
	
		if($d != null)
		{
			
			switch (date_format($d,"n")) // on indique sur quelle variable on travaille
			{ 
			
				case 1: 
					return "Janvier";
				break;
				
				case 2: 
					return "Février";
				break;
				
				case 3: 
					return "Mars";
				break;
				
				case 4: 
					return "Avril";
				break;
				
				case 5: 
					return "Mai";
				break;
				
				case 6:
					return "Juin";
				break;
				
				case 7:
					return "Juillet";
				break;
				
				case 8: 
					return "Août";
				break;
				
				case 9: 
					return "Septembre";
				break;
				
				case 10: 
					return "Otocbre";
				break;
				
				case 11:
					return "Novembre";
				break;
				
				case 12:
					return "Décembre";
				break;
				
			}
			
		}
		else
		{
			
			return "";
			
		}
		
    }
	

    /**
     * Add commentaire
     *
     * @param \Erico\ApiBundle\Entity\Commentaire $commentaire
     *
     * @return Publication
     */
    public function addCommentaire(\Erico\ApiBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Erico\ApiBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Erico\ApiBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
		
		$result = array();
		
		$tail = count($this->commentaires)-1;
		
		for($i=$tail; $i >=0; $i--)
		{
			if( !$this->commentaires[$i]->getArchiver() and $this->commentaires[$i]->getApprouver() ){
			
				$result[] = $this->commentaires[$i];
				
			}
			
		}
		
        /* foreach($this->commentaires as $elem){
			
			if( !$elem->getArchiver() and $elem->getApprouver() ){
			
				$result[] = $elem;
				
			}
		
		} */
		
		return $result;
		
		//return $this->commentaires;
    }
}
