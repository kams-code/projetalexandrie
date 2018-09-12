<?php

namespace Alexandrie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EWZ\Bundle\SearchBundle\Lucene\LuceneSearch;

class SearchController extends Controller
{
    
	public function searchPara($search_parameter)
    {
		
		$result = array();
		//$mE = new MyService;
		
		$exception = $this->container->get('api.myservice')->exceptionkeyword();

		$em = $this->getDoctrine()->getManager();
		$result = $em->getRepository('EricoApiBundle:Paragraphe')->Search($search_parameter['q'], $search_parameter['pub'], $search_parameter['num'], $search_parameter['op'], $search_parameter['date1'], $search_parameter['date2'], $search_parameter['juridiction'], $search_parameter['section'], $search_parameter['nature']);

		$result2 = array();
			
		foreach($result as $elem)
		{
			$elem->{'type'} = "Paragraphe";

			$elem->{'pertinence'} = 0;
			
			$elem->{'link'} = $this->generateUrl('alexandrie_frontend_textepage', array('id'=>$elem->getTexte()->getId(), 'titre'=>$elem->getTexte()->titreRewrite())).'#title'.$elem->getId();
			
			$tabstr = explode(" ", $search_parameter['q']);

			//remplacement de la chain dans le titre
			$titre = $elem->getDesignation();

			if(stripos($titre, $search_parameter['q'])){
				$titre = str_ireplace ( $search_parameter['q'], '<span style="background-color:yellow;">'.$search_parameter['q'].'</span>', $elem->getDesignation());
				$elem->{'pertinence'} += (count($tabstr) * 15);
			}
			
			//remplacement des mots dans le titre
			if(count($tabstr)>1){
				
				foreach($tabstr as $m)
				{
					
					if( strlen($m) > 2 and !(in_array($m, $exception)))
					{
						if(stripos($titre, $m))
						{
							
							$titre = str_ireplace ( $m, '<span style="background-color:yellow; ">'.$m.'</span>', $titre);
							$elem->{'pertinence'} += 10;
						}
						
					}
					
				} 
					
			}
			
			$elem->{'titre'} = $titre.' <span style="color:#000">( '.$elem->getTexte()->getDesignation().' )</span>';
			
			//$elem->{'link'} = $this->generateUrl('legiafrica_frontend_textepage', array('id'=>$elem->getTexte()->getId(), 'titre'=>$elem->getTexte()->titreRewrite())).'#title'.$elem->getId();
			
			
			
			
			//recuperation du contenu
			//$ch = mb_convert_encoding(strip_tags ($elem->getDescription()), 'UTF-8', 'HTML-ENTITIES');
			$ch = strip_tags ($elem->getDescription());
			
			$ch2 = "";
			
			//remplacement de la chaine entière
			$chaineEntiere = $search_parameter['q'];
			$chaineEntiere = $this->container->get('api.myservice')->converToSpecialChar($chaineEntiere);
			
			if(stripos($ch, $chaineEntiere))
			{
				$start = stripos($ch, $chaineEntiere);
				if($start > 150)
				$start -= 150;
				else
				$start = 0; 
			
				$ch2 .= substr( $ch, $start, 300).'...';
				$ch2 = str_ireplace ( $chaineEntiere, '<span style="background-color:yellow; ">'.$chaineEntiere.'</span>', $ch2);
				$elem->{'pertinence'} += (count($tabstr) * 5);
			}
			
			//remplacement des mots
			if( count($tabstr)>1 and $ch2 == ""){
				
				foreach($tabstr as $m)
				{
		
					if(  $ch2 == "" and strlen($m) > 2 and !(in_array($m, $exception)) )
					{
						//convertion des caractère spéciaux
						$m = $this->container->get('api.myservice')->converToSpecialChar($m);
						
						if(stripos($ch, $m))
						{
							$start = stripos($ch, $m);
							if($start > 150)
							$start -= 150;
							else
							$start = 0; 
						
							$ch2 .= substr( $ch, $start, 300).'...';
							$ch2 = str_ireplace ( $m, '<span style="background-color:yellow;">'.$m.'</span>', $ch2);
							$elem->{'pertinence'} += 1;
						}
						
					}
					
				} 
					
			}
			
		
			if($ch2 != "")
			{
				$elem->{'sum'} = $ch2;
			}
			else
			{
				$elem->{'sum'} = substr ($ch, 0, 300).'...';
			}
			
	
			$result2[] = $elem;
			
			
		}
		
		//usort Trie un tableau en utilisant la  fonction de comparaison personnalisée pertinenceSearch
		usort($result2, array($this, "pertinenceSearch"));
		
		return $result2;
	}
	
	public function pertinenceSearch($a, $b) {
			
		if ($a->pertinence == $b->pertinence) {
			return 0;
		}
		return ($a->pertinence > $b->pertinence) ? -1 : 1;
		
	}
	
	public function searchresultAction()
    {
        
		/* $search = $this->get('ewz_search.lucene.manager')->getIndex('indexBar');
		
		$query = 'loi';

		$results = $search->find($query);
		
		$posts = new \Doctrine\Common\Collections\ArrayCollection;
		$em = $this->getDoctrine()->getManager();
		
		foreach($results as $hit)
		{
			$document = $hit->getDocument();
			$post = $em->getRepository('EricoApiBundle:Paragraphe')->find($document->key);
			//$post = $hit->getDocument();
			$posts->add($post);
		} */
		
		
		$em = $this->getDoctrine()->getManager();
		$request = $this->get('request');
		
		$search_parameter = array();
		$ch = $request->query->get('q');
		//$search_parameter['q'] = "PROCÉDURES COLLECTIVES";
		$search_parameter['q'] = mb_strtolower( str_ireplace( "'", " ", $ch) );
		
		//$search_parameter['q'] = mb_strtolower($ch);

		$search_parameter['pub'] = $request->query->get('pub');
		$search_parameter['num'] = $request->query->get('num');
		$search_parameter['op'] = $request->query->get('op');
		$search_parameter['date1'] = $request->query->get('date1');
		$search_parameter['date2'] = $request->query->get('date2');
		$search_parameter['juridiction'] = $request->query->get('juridiction');
		$search_parameter['section'] = $request->query->get('section');
		$search_parameter['nature'] = $request->query->get('nature');
		
		$result = array();
		
		//on remete le parametres search pour les autres fonction comme la pagination
		
		//ensuite on recherche dabord dans les paragraphes
			
		$result = $this->searchPara($search_parameter);
		
		$nbrresultats = count($result);
		
		$numpage = $request->query->get('numpage'); 
		if($numpage == "")
		$numpage = 1;
		
		// nbr resultat par page
		$nbrResult = 10;
			
		if($nbrResult != 0)
		$nbrPage = (int)(count($result)/$nbrResult);
		else
		$nbrPage = 0;	
		
		//$nbrPage = (int)($textes/$nbrResult); // partie entiere
		if($nbrResult != 0)
		$reste = (count($result)) % $nbrResult; // reste
		else
		$reste = 0;
		
		if($reste > 0)
			$nbrPage++;
		
		//affichage des pages en partant sur le principe d'affciher 5 pages
		$Pages = $this->searchPaginationLink($nbrPage, $numpage, $search_parameter['q'], $search_parameter['pub'], $search_parameter['num'], $search_parameter['op'], $search_parameter['date1'], $search_parameter['date2'], $search_parameter['juridiction'], $search_parameter['section'], $search_parameter['nature']);
		
		//preparation parametres de la requette
		$debutresultat = 0;
		
		if($numpage > 1 )
		{
			$debutresultat = $nbrResult * ($numpage-1);//car le numero de page peut etre negatif
		}
		
		
		$tab = $result;
		$resultats = array();
		
		$comp = 0;
		
		while( $comp < $nbrResult )
		{
			$index = $debutresultat + $comp;
			
			if(isset($tab[$index]))
			{
				$resultats[] = $tab[$index];
			}
			
			$comp++;
		}
				
		return $this->render('AlexandrieFrontendBundle:Default:searchresult.html.twig', array('result'=>$resultats, 'search_parameter'=>$search_parameter, 'page'=>$Pages,));
    
	}
	
	public function searchLinkPage($i, $numpage, $text, $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature)
	{
		$Page = '';
		if ($numpage == $i)
		$Page.='<li class="active"><a href="#"> Page '.$text.'</a></li>';
		else 
		$Page.='<li><a href="'.$this->generateUrl('alexandrie_frontend_searchresultpage').'?numpage='.$i.'&q='.$q.'&pub='.$pub.'&num='.$num.'&op='.$op.'&date1='.$date1.'&date2='.$date2.'&juridiction='.$juridiction.'&section='.$section.'&nature='.$nature.'">'.$text.'</a></li>';
		
		return $Page;
	}
	
	public function searchPaginationLink($nbrPage, $numpage, $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature)
	{
		
		$Pages = '';
		
		if ($nbrPage <= 4)
		{
			for($i=1; $i <= $nbrPage; $i++)
			{
				
				$Pages .= $this->searchLinkPage($i, $numpage, $i, $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature);
				
			}
		}
		else
		{
			
			if($numpage>1)
			{
				$Pages.=$this->searchLinkPage(1, $numpage, '<i class="fa fa-angle-double-left"></i>', $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature); 
				$Pages.=$this->searchLinkPage($numpage-1, $numpage, '<i class="fa fa-angle-left"></i>', $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature); 
			}
			
			$Pages.= $this->searchLinkPage($nbrPage, $nbrPage, $numpage.' / '.$nbrPage, $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature);
			
			if($numpage < $nbrPage)
			{
				$Pages.=$this->searchLinkPage($numpage+1, $numpage, '<i class="fa fa-angle-right"></i>', $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature);
				$Pages.=$this->searchLinkPage($nbrPage, $numpage, '<i class="fa fa-angle-double-right"></i>', $q, $pub, $num, $op, $date1, $date2, $juridiction, $section, $nature);
			}
			
		}
		
		return $Pages;
		
	}
	
	
}
