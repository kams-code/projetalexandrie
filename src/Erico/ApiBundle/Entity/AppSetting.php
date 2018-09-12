<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppSetting
 *
 */
class AppSetting
{
    
    /**
     * @var string
     *
     */
    private $htmlheader;

    /**
     * @var string
     *
     */
    private $htmlfooter;

    /**
     * @var string
     *
     */
    private $piwik;

    /**
     * @var string
     *
     */
    private $copyright;

    
	/**
     * @var string
     */
    private $clientIDPaypal;
	
	/**
     * @var string
     */
    private $secretPaypal;
	
	/**
     * @var string
     */
    private $envPaypal;
	
	/**
     * @var boolean
     */
    private $javascriptPaypal;
	
	
    /**
     * Set htmlheader
     *
     * @param string $htmlheader
     *
     * @return AppSetting
     */
    public function setHtmlheader($htmlheader)
    {
        $this->htmlheader = $htmlheader;

        return $this;
    }

    /**
     * Get htmlheader
     *
     * @return string
     */
    public function getHtmlheader()
    {
        return $this->htmlheader;
    }

    /**
     * Set htmlfooter
     *
     * @param string $htmlfooter
     *
     * @return AppSetting
     */
    public function setHtmlfooter($htmlfooter)
    {
        $this->htmlfooter = $htmlfooter;

        return $this;
    }

    /**
     * Get htmlfooter
     *
     * @return string
     */
    public function getHtmlfooter()
    {
        return $this->htmlfooter;
    }

    /**
     * Set piwik
     *
     * @param string $piwik
     *
     * @return AppSetting
     */
    public function setPiwik($piwik)
    {
        $this->piwik = $piwik;

        return $this;
    }

    /**
     * Get piwik
     *
     * @return string
     */
    public function getPiwik()
    {
        return $this->piwik;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     *
     * @return AppSetting
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }
	
	public function file()
    {
        return "appconfig.txt";
    }
	
	public function save()
    {
		$store = serialize ($this);
		file_put_contents($this->file(), $store);
    }
	
	/**
     * Set clientIDPaypal
     *
     * @param string $clientIDPaypal
     *
     * @return Setting
     */
    public function setClientIDPaypal($clientIDPaypal)
    {
        $this->clientIDPaypal = $clientIDPaypal;

        return $this;
    }

    /**
     * Get clientIDPaypal
     *
     * @return string
     */
    public function getClientIDPaypal()
    {
        return $this->clientIDPaypal;
    }
	
	/**
     * Set secretPaypal
     *
     * @param string $secretPaypal
     *
     * @return Setting
     */
    public function setSecretPaypal($secretPaypal)
    {
        $this->secretPaypal = $secretPaypal;

        return $this;
    }

    /**
     * Get secretPaypal
     *
     * @return string
     */
    public function getSecretPaypal()
    {
        return $this->secretPaypal;
    }
	
	/**
     * Set envPaypal
     *
     * @param string $envPaypal
     *
     * @return Setting
     */
    public function setEnvPaypal($envPaypal)
    {
        $this->envPaypal = $envPaypal;

        return $this;
    }

    /**
     * Get envPaypal
     *
     * @return string
     */
    public function getEnvPaypal()
    {
        return $this->envPaypal;
    }
	
	/**
     * Set javascriptPaypal
     *
     * @param boolean $javascriptPaypal
     *
     * @return Setting
     */
    public function setJavascriptPaypal($javascriptPaypal)
    {
        $this->javascriptPaypal = $javascriptPaypal;

        return $this;
    }
	
	/**
     * Get javascriptPaypal
     *
     * @return boolean
     */
    public function getJavascriptPaypal()
    {
        return $this->javascriptPaypal;
    }
}


