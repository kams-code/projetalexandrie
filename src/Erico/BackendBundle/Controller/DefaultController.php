<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Categorie;
use Erico\ApiBundle\Form\CategorieType;
use Erico\ApiBundle\Entity\Keyword;
use Erico\ApiBundle\Form\KeywordType;
use Erico\ApiBundle\Entity\Nature;
use Erico\ApiBundle\Form\NatureType;
use Erico\ApiBundle\Entity\Setting;
use Erico\ApiBundle\Entity\AppSetting;

use Symfony\Component\HttpFoundation\Response;

//use EWZ\Bundle\SearchBundle\Lucene\LuceneSearch;
use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;

class DefaultController extends Controller
{
    
	public function indexAction()
    {
		//on augmente de le temps d'excution du script à 10H = 3600 * 10 s pour éviter Error: Maximum execution time of 120 seconds exceeded
		ini_set('max_execution_time', 3600*10);
		
		$setting = $this->appconfig();
		
		/* $em = $this->getDoctrine()->getManager();
		$results = $em->getRepository('EricoApiBundle:Paragraphe')->findBy(array('archiver'=>false), array());
				
		foreach($results as $elem)
		{
			
			$this->createIndex($elem);
		} */
		
		return $this->render('EricoBackendBundle:Default:index.html.twig', array('setting'=>$setting));
		
	}
	
	private function createIndex($post)
	{
		//On récupère l'index qui n'inclure pas des nombres dans nos requêtes de recherche
		$search = $this->get('ewz_search.lucene.manager')->getIndex('indexFoo');
		
		//on supprime
		$description = strip_tags($post->getDescription());
		$document = new Document();
		$document->addField(Field::Keyword('key', $post->getId()));
		$document->addField(Field::text('title', $post->getDesignation()));
		$document->addField(Field::UnStored('description', $description));

		$search->addDocument($document); // si l'index existe déjà il sera simplement mis à jour
		$search->updateIndex();
		
	}
	
	public function sidebarmenuAction()
    {
		$em = $this->getDoctrine()->getManager();
		$message = $em->getRepository('EricoApiBundle:Message')->findBy(array('archiver'=>false, 'lecture'=>false), array());
		$comment = $em->getRepository('EricoApiBundle:Commentaire')->findBy(array('archiver'=>false, 'approuver'=>false), array());
		$nbrmessage = count($message);
		$nbrcomment = count($comment);
		
		return $this->render('EricoBackendBundle:Default:sidebarmenu.html.twig', array('nbrmessage'=>$nbrmessage, 'nbrcomment'=>$nbrcomment));
	}
	
	
	
	public function popupFormAction()
    {
		
		$cat = new Categorie;
		$em = $this->getDoctrine()->getManager();
	    $formCat = $this->createForm(new CategorieType, $cat, array('idcat'=>0));
		
		$key = new Keyword;
		$em = $this->getDoctrine()->getManager();
	    $formKeyword = $this->createForm(new KeywordType, $key);
		
		$nature = new Nature;
		$em = $this->getDoctrine()->getManager();
	    $formNature = $this->createForm(new NatureType, $nature);
		  
		return $this->render('EricoBackendBundle:Default:popupForm.html.twig', array('form_cat' => $formCat->createView(), 'form_keyword' => $formKeyword->createView(), 'form_nature' => $formNature->createView()));
	
	}
	
	public function archiverAction()
    {
		
		$request = $this->getRequest();
		
		$idcontent = $request->query->get('idcontent');
		$em = $this->getDoctrine()->getManager();
		
		$content = $em->getRepository('EricoApiBundle:Content')->find($idcontent);
		
		$content->setArchiver(true);
	
		
		$content = $em->getRepository('EricoApiBundle:Publication')->find($idcontent);
		
		if($content!= null)
		{
			$texte = $em->getRepository('EricoApiBundle:Texte')->find($idcontent);
			if($texte!= null)
			{
				foreach($texte->getParagraphes() as $elem){
			
					 $elem->setArchiver(true);
					
				}
				$texte->setPublier(false);
			}
			else
			{
				$content->setPublier(false);
			}
		}
			
		$content = $em->getRepository('EricoApiBundle:Paragraphe')->find($idcontent);
		
		if($content!= null)
		{

			foreach($content->getFils() as $elem){
		
				 $elem->setArchiver(true);
				
			}
			
		}
		
		$content = $em->getRepository('EricoApiBundle:Commentaire')->find($idcontent);
		
		if($content!= null)
		{
			
			foreach($content->getFils() as $elem){
				
				$elem->setArchiver(true);
				
			
			}
			
		}
		
		
		$em->flush();
		
		$response = new Response("ok");
		return $response;
		
	}
	
	public function config()
    {
		$setting = new Setting;
		
		if ( file_exists($setting->file())) {
			
			$store = file_get_contents($setting->file());
			$setting = unserialize($store);
		}
		
		
		return $setting;
		
	}
	
	public function appconfig()
    {
		$setting = new AppSetting;
		
		if ( file_exists($setting->file())) {
			
			$store = file_get_contents($setting->file());
			$setting = unserialize($store);
		}
		
		
		return $setting;
		
	}
	
	
}
