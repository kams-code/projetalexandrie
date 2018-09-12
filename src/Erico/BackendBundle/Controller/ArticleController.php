<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Article;
use Erico\ApiBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function indexAction()
    {
		
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('EricoApiBundle:Article')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Article:index.html.twig', array('articles' => $articles));
		
    }
	
	public function addAction()
    {
        
		$article = new Article;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new ArticleType, $article);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    
		    $em->persist($article);
		    $em->flush();
			
			
			return $this->redirect($this->generateUrl('erico_backend_article_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Article:form.html.twig', array('form_article' => $form->createView()));
    
	}
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$article = $em->getRepository('EricoApiBundle:Article')->find($id);
		
		$form = $this->createForm(new ArticleType, $article);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$article->setDateModif(new \DateTime());
		    $em->flush();
			return $this->redirect($this->generateUrl('erico_backend_article_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Article:form.html.twig', array('form_article' => $form->createView()));

		
    }
	
}