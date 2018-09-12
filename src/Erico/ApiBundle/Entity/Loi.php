<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Texte;

/**
 * Loi
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\LoiRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({"loi"="Loi", "texteloi"="Erico\ApiBundle\Entity\TexteLoi", "jurisprudence"="Erico\ApiBundle\Entity\Jurisprudence"})
 */
 
class Loi extends Texte
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="num", type="string", length=255, nullable=true)
     */
    private $num;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_loi", type="datetime", nullable=true)
     */
    private $dateLoi;

	
	
    public function __construct()
	{
		parent::__construct();

	}

    /**
     * Set num
     *
     * @param string $num
     *
     * @return Loi
     */
    public function setNum($num)
    {
        $this->num = $num;

        return $this;
    }

    /**
     * Get num
     *
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Set dateLoi
     *
     * @param \DateTime $dateLoi
     *
     * @return Loi
     */
    public function setDateLoi($dateLoi)
    {
        $this->dateLoi = $dateLoi;

        return $this;
    }

    /**
     * Get dateLoi
     *
     * @return \DateTime
     */
    public function getDateLoi()
    {
        return $this->dateLoi;
    }
	
	
	
	
	public function monthDateLoi()
    {
        
		
		if($this->dateLoi!=null)
		{
			
			switch (date_format($this->dateLoi,"n")) // on indique sur quelle variable on travaille
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
			
		}else
		{
			
			return "";
			
		}
		
    }
	
}

