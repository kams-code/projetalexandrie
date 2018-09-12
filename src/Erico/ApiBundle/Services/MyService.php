<?php

// src/Erico/ApiBundle/Services/MyService.php
namespace Erico\ApiBundle\Services;


class MyService
{
	 
	/**
	* Recherche les caractères spéciaux  dans la chaine et les remplace par leur équivalence
	* Ensuite return la chaine modifier
	* 
	*
	 @param string $ch
	*/
 
    public function converToSpecialChar($ch) {
			
		$specialChar = array('&quot;', '&lt;', '&gt;', '&laquo;', '&raquo;', '&amp;', '&euro;', '&yen;', '&copy;', '&reg;', '&agrave;', '&acirc;', '&eacute;', '&egrave;', '&ecirc;', '&icirc;', '&iuml;', '&oelig;', '&ugrave;', '&ucirc;', '&ccedil;');
		$notspecialChar = array('"', '<', '>', '«', '»', '&', '€', '¥', '©', '®', 'à', 'â', 'é', 'è', 'ê', 'î', 'ï', 'œ', 'ù', 'û', 'ç');
		for($i=0; $i < count($specialChar); $i++)
		{
			$ch = str_ireplace ( $notspecialChar[$i], $specialChar[$i], $ch);
		}
		
		return $ch;
    }
 
    public function exceptionkeyword() {
		$exception = array('les', 'ils', 'elles', 'elle', 'vous', 'nous', 'des', 'pas', 'pour', 'mais', 'non', 'dans', 'une', 'une',  'quoi', 'quel',  'quelles', 'qui', 'mon', 'notre', 'votre', 'leur', 'son', 'par', 'pour', 'aux', 'sur');
		return $exception;
    }
	
  
}