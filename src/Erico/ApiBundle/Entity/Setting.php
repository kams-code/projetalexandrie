<?php

namespace Erico\ApiBundle\Entity;


/**
 * Setting
 *
 */
class Setting //la suppression d'un champ entraine une erreur lors de la deserialization car la propriete est introuvable donc eviter de supprimer les propriete deja serialize
{
    

    /**
     * @var string
     */
    private $titreSite;
	
	/**
     * @var string
     */
    private $description;
	
	/**
     * @var string
     */
    private $logo;
	
	/**
     * @var string
     */
    private $googlemap;
	
	/**
     * @var string
     */
    private $icone;
	
	/**
     * @var string
     */
    private $cgu;
	

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string
     */
    private $email;
	
	/**
     * @var string
     */
    private $adresse;

	/**
     * @var integer
     */
	private $aLaUne;

	
	/**
     * @var string
     */
    private $facebook;
	
	/**
     * @var string
     */
    private $twitter;
	
	/**
     * @var string
     */
    private $youtube;
	
	/**
     * @var string
     */
    private $google;
	
	
	/**
     * @var string
     */
    private $linkedin;
	
	
	/**
     * @var string
     */
    private $viadeo;
	
	
	/**
     * @var integer
     */
    private $mainmenu;
	
	/**
     * @var integer
     */
    private $secondarymenu;
	
	/**
     * @var integer
     */
    private $menu3;
	
	/**
     * @var integer
     */
    private $menu4;
	
	/**
     * @var integer
     */
    private $menu5;
	
	
	/**
     * @var boolean
     */
    private $souscription;
	
	/**
     * @var boolean
     */
    private $connexionRequire;
	
	
	
	/**
     * Constructor
     */
    public function __construct()
    {
		$this->aLaUne = 0;
		$this->mainmenu = 0;
		$this->secondarymenu = 0;
		
		//$this->archiver = false;
    }
	
    /**
     * Set titreSite
     *
     * @param string $titreSite
     *
     * @return Setting
     */
    public function setTitreSite($titreSite)
    {
        $this->titreSite = $titreSite;

        return $this;
    }

    /**
     * Get titreSite
     *
     * @return string
     */
    public function getTitreSite()
    {
        return $this->titreSite;
    }
	
	/**
     * Set description
     *
     * @param string $description
     *
     * @return Setting
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Setting
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Setting
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Setting
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
	
	
	/**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Setting
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
	
	/**
     * Set googlemap
     *
     * @param string $googlemap
     *
     * @return Setting
     */
    public function setGooglemap($googlemap)
    {
        $this->googlemap = $googlemap;

        return $this;
    }

    /**
     * Get googlemap
     *
     * @return string
     */
    public function getGooglemap()
    {
        return $this->googlemap;
    }
	
	/**
     * Set icone
     *
     * @param string $icone
     *
     * @return Setting
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }
	
	
	/**
     * Set cgu
     *
     * @param string $cgu
     *
     * @return Setting
     */
    public function setCgu($cgu)
    {
        $this->cgu = $cgu;

        return $this;
    }

    /**
     * Get cgu
     *
     * @return string
     */
    public function getCgu()
    {
        return $this->cgu;
    }
	
	
	/**
     * Set aLaUne
     *
     * @param integer $aLaUne
     *
     * @return Setting
     */
    public function setALaUne($aLaUne)
    {
        $this->aLaUne = $aLaUne;

        return $this;
    }

    /**
     * Get aLaUne
     *
     * @return integer
     */
    public function getALaUne()
    {
        return $this->aLaUne;
    }
	
	
	
    public function file()
    {
        return "config.txt";
    }

	
	/**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Setting
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }
	
	
	/**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Setting
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }
	
	
	/**
     * Set youtube
     *
     * @param string $youtube
     *
     * @return Setting
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string
     */
    public function getYoutube()
    {
        return $this->youtube;
    }
	
	
	/**
     * Set google
     *
     * @param string $google
     *
     * @return Setting
     */
    public function setGoogle($google)
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google
     *
     * @return string
     */
    public function getGoogle()
    {
        return $this->google;
    }
	
	
	/**
     * Set linkedin
     *
     * @param string $linkedin
     *
     * @return Setting
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }
	
	
	/**
     * Set viadeo
     *
     * @param string $viadeo
     *
     * @return Setting
     */
    public function setViadeo($viadeo)
    {
        $this->viadeo = $viadeo;

        return $this;
    }

    /**
     * Get viadeo
     *
     * @return string
     */
    public function getViadeo()
    {
        return $this->viadeo;
    }
	
	
	public function save()
    {
		$store = serialize ($this);
		file_put_contents($this->file(), $store);
    }
	
	
	/**
     * Set mainmenu
     *
     * @param integer $mainmenu
     *
     * @return Setting
     */
    public function setMainmenu($mainmenu)
    {
        $this->mainmenu = $mainmenu;

        return $this;
    }
	
	/**
     * Get mainmenu
     *
     * @return integer
     */
    public function getMainmenu()
    {
        return $this->mainmenu;
    }
	
	
	/**
     * Set secondarymenu
     *
     * @param integer $secondarymenu
     *
     * @return Setting
     */
    public function setSecondarymenu($secondarymenu)
    {
        $this->secondarymenu = $secondarymenu;

        return $this;
    }
	
	/**
     * Get secondarymenu
     *
     * @return integer
     */
    public function getSecondarymenu()
    {
        return $this->secondarymenu;
    }
	
	
	/**
     * Set menu3
     *
     * @param integer $menu3
     *
     * @return Setting
     */
    public function setMenu3($menu3)
    {
        $this->menu3 = $menu3;

        return $this;
    }
	
	/**
     * Get menu3
     *
     * @return integer
     */
    public function getMenu3()
    {
        return $this->menu3;
    }
	
	/**
     * Set menu4
     *
     * @param integer $menu4
     *
     * @return Setting
     */
    public function setMenu4($menu4)
    {
        $this->menu4 = $menu4;

        return $this;
    }
	
	/**
     * Get menu4
     *
     * @return integer
     */
    public function getMenu4()
    {
        return $this->menu4;
    }
	
	
	/**
     * Set menu5
     *
     * @param integer $menu5
     *
     * @return Setting
     */
    public function setMenu5($menu5)
    {
        $this->menu5 = $menu5;

        return $this;
    }
	
	/**
     * Get menu5
     *
     * @return integer
     */
    public function getMenu5()
    {
        return $this->menu5;
    }
	
	/**
     * Set souscription
     *
     * @param boolean $souscription
     *
     * @return Setting
     */
    public function setSouscription($souscription)
    {
        $this->souscription = $souscription;

        return $this;
    }
	
	/**
     * Get souscription
     *
     * @return boolean
     */
    public function getSouscription()
    {
        return $this->souscription;
    }
	
	/**
     * Set connexionRequire
     *
     * @param boolean $connexionRequire
     *
     * @return Setting
     */
    public function setConnexionRequire($connexionRequire)
    {
        $this->connexionRequire = $connexionRequire;

        return $this;
    }
	
	/**
     * Get connexionRequire
     *
     * @return boolean
     */
    public function getConnexionRequire()
    {
        return $this->connexionRequire;
    }
	
	
}

