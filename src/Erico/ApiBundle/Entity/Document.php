<?php

namespace Erico\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Erico\ApiBundle\Entity\DocumentRepository")
 */
class Document extends Texte
{
    
	public function __construct()
	{
		parent::__construct();

	}
}

