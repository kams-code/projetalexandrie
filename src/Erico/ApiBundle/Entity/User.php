<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\UserRepository")
 */
class User implements AdvancedUserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;
	
	
	private $plainPassword;

	// Chaque utilisateur va se voir attribuer une clé ( attribut salt ) permettant 
    // de saler son mot de passe. Cela n'est pas obligatoire,
    // sa valeur modifier lors de l'encodage du mot de passe voir la fonction encodePassword
	
    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;
	
	
	/**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastConnection", type="datetime", nullable=true)
     */
    private $lastConnection;

	
	
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="newletter", type="boolean")
     */
    private $newletter;
	
	/**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", nullable=true)
     */
    private $adresse;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="confirmationToken", type="string", length=255, nullable=true)
     */
    private $confirmation_token;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="resetToken", type="string", length=255, nullable=true)
     */
    private $resetToken;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="resetTokenAt", type="datetime", nullable=true)
     */
    private $resetTokenAt;
	
	/**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;
	
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="email_is_confirm", type="boolean")
     */
    private $emailIsConfirm;
	
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="datetime", nullable=true)
     */
    private $expiration;
	
	/**
     * @var \Date
     *
     * @ORM\Column(name="birdthday", type="date", nullable=true)
     */
    private $birdthday;
	
	/**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255, nullable=true)
     */
    private $profession;
	
	
	/**
     * @var string
     *
     * @ORM\Column(name="fixephone", type="string", length=255, nullable=true)
     */
    private $fixephone;
	
	
	/**
     * @var integer
     *
     * @ORM\Column(name="civility", type="integer")
     */
    private $civility;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="sms", type="boolean")
     */
    private $sms;
	
	
	public function __construct()
	{
		$this->roles = array('ROLE_USER');
		//$this->roles = array('ROLE_USER', 'ROLE_CHAT_AGENT');
		$this->newletter = true;
		$this->sms = true;
		$this->isActive = false;
		$this->emailIsConfirm = false;
		$this->dateCreation = new \DateTime();
		$this->expiration = new \DateTime();
		$this->salt = null;
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

   
    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return User
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set lastConnection
     *
     * @param \DateTime $lastConnection
     *
     * @return User
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * Get lastConnection
     *
     * @return \DateTime
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }
	
	//obligatoire de par l'interface : UserInterface
	public function eraseCredentials()
	{
		$this->setPlainPassword(null);
	}

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
	
	// fonctions obligatoire de  AdvancedUserInterface
	
	public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }


    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set newletter
     *
     * @param boolean $newletter
     *
     * @return User
     */
    public function setNewletter($newletter)
    {
        $this->newletter = $newletter;

        return $this;
    }

    /**
     * Get newletter
     *
     * @return boolean
     */
    public function getNewletter()
    {
        return $this->newletter;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
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
     * Set status
     *
     * @param string $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
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
	
	
	public function getPlainPassword()
    {
        return $this->plainPassword;
    }
 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
 
        return $this;
    }
	
	/**
     * @param PasswordEncoderInterface $encoder
     */
    public function encodePassword(PasswordEncoderInterface $encoder)
    {
        if ($this->plainPassword) {
            $this->salt = sha1(uniqid(mt_rand()));
            $this->password = $encoder->encodePassword(
                $this->plainPassword,
                $this->salt
            );
 
            $this->eraseCredentials();
        }
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return User
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set emailIsConfirm
     *
     * @param boolean $emailIsConfirm
     *
     * @return User
     */
    public function setEmailIsConfirm($emailIsConfirm)
    {
        $this->emailIsConfirm = $emailIsConfirm;

        return $this;
    }

    /**
     * Get emailIsConfirm
     *
     * @return boolean
     */
    public function getEmailIsConfirm()
    {
        return $this->emailIsConfirm;
    }
	

    /**
     * Set expiration
     *
     * @param \DateTime $expiration
     *
     * @return User
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * Get expiration
     *
     * @return \DateTime
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

   
	

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     *
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmation_token = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmation_token;
    }

    /**
     * Set resetToken
     *
     * @param string $resetToken
     *
     * @return User
     */
    public function setResetToken($resetToken)
    {
        $this->resetToken = $resetToken;

        return $this;
    }

    /**
     * Get resetToken
     *
     * @return string
     */
    public function getResetToken()
    {
		
        return $this->resetToken;
    }

    /**
     * Set resetTokenAt
     *
     * @param \DateTime $resetTokenAt
     *
     * @return User
     */
    public function setResetTokenAt($resetTokenAt)
    {
        $this->resetTokenAt = $resetTokenAt;

        return $this;
    }

    /**
     * Get resetTokenAt
     *
     * @return \DateTime
     */
    public function getResetTokenAt()
    {
        return $this->resetTokenAt;
    }
	
	

    /**
     * Set birdthday
     *
     * @param \DateTime $birdthday
     *
     * @return User
     */
    public function setBirdthday($birdthday)
    {
        $this->birdthday = $birdthday;

        return $this;
    }

    /**
     * Get birdthday
     *
     * @return \DateTime
     */
    public function getBirdthday()
    {
        return $this->birdthday;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return User
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set fixephone
     *
     * @param string $fixephone
     *
     * @return User
     */
    public function setFixephone($fixephone)
    {
        $this->fixephone = $fixephone;

        return $this;
    }

    /**
     * Get fixephone
     *
     * @return string
     */
    public function getFixephone()
    {
        return $this->fixephone;
    }

    /**
     * Set civility
     *
     * @param integer $civility
     *
     * @return User
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return integer
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set sms
     *
     * @param boolean $sms
     *
     * @return User
     */
    public function setSms($sms)
    {
        $this->sms = $sms;

        return $this;
    }

    /**
     * Get sms
     *
     * @return boolean
     */
    public function getSms()
    {
        return $this->sms;
    }
}
