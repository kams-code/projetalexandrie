<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Texte;

/**
 * Doctrine
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Doctrine extends Texte
{
    
    /**
     * @var string
     *
     * @ORM\Column(name="nomAuteur", type="string", length=255)
     */
    private $nomAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="titreAuteur", type="string", length=255)
     */
    private $titreAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="text")
     */
    private $specialite;

    /**
     * @var integer
     *
     * @ORM\Column(name="bp", type="integer")
     */
    private $bp;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="motCle", type="string", length=255)
     */
    private $motCle;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuDePublication", type="string", length=255)
     */
    private $lieuDePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="titreDocument", type="string", length=255)
     */
    private $titreDocument;


    /**
     * Set nomAuteur
     *
     * @param string $nomAuteur
     *
     * @return Doctrine
     */
    public function setNomAuteur($nomAuteur)
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    /**
     * Get nomAuteur
     *
     * @return string
     */
    public function getNomAuteur()
    {
        return $this->nomAuteur;
    }

    /**
     * Set titreAuteur
     *
     * @param string $titreAuteur
     *
     * @return Doctrine
     */
    public function setTitreAuteur($titreAuteur)
    {
        $this->titreAuteur = $titreAuteur;

        return $this;
    }

    /**
     * Get titreAuteur
     *
     * @return string
     */
    public function getTitreAuteur()
    {
        return $this->titreAuteur;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     *
     * @return Doctrine
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set bp
     *
     * @param integer $bp
     *
     * @return Doctrine
     */
    public function setBp($bp)
    {
        $this->bp = $bp;

        return $this;
    }

    /**
     * Get bp
     *
     * @return integer
     */
    public function getBp()
    {
        return $this->bp;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Doctrine
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
     * @return Doctrine
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
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Doctrine
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set motCle
     *
     * @param string $motCle
     *
     * @return Doctrine
     */
    public function setMotCle($motCle)
    {
        $this->motCle = $motCle;

        return $this;
    }

    /**
     * Get motCle
     *
     * @return string
     */
    public function getMotCle()
    {
        return $this->motCle;
    }

    /**
     * Set lieuDePublication
     *
     * @param string $lieuDePublication
     *
     * @return Doctrine
     */
    public function setLieuDePublication($lieuDePublication)
    {
        $this->lieuDePublication = $lieuDePublication;

        return $this;
    }

    /**
     * Get lieuDePublication
     *
     * @return string
     */
    public function getLieuDePublication()
    {
        return $this->lieuDePublication;
    }

    /**
     * Set titreDocument
     *
     * @param string $titreDocument
     *
     * @return Doctrine
     */
    public function setTitreDocument($titreDocument)
    {
        $this->titreDocument = $titreDocument;

        return $this;
    }

    /**
     * Get titreDocument
     *
     * @return string
     */
    public function getTitreDocument()
    {
        return $this->titreDocument;
    }

    public function _construct()
    {
        
        
    }
}

