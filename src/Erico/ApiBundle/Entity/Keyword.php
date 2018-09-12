<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Erico\ApiBundle\Entity\Content;

/**
 * Keyword
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\KeywordRepository")
 */
class Keyword extends Content
{
   
    

	public function __construct()
	{
		parent::__construct();

	}

    
}

