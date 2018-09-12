<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Nature;
use Erico\ApiBundle\Form\NatureType;
use Symfony\Component\HttpFoundation\Response;

class NatureController extends Controller
{
    public function indexAction()
    {
		/*
        $em = $this->getDoctrine()->getManager();
        $keys = $em->getRepository('EricoApiBundle:Keyword')->findBy(array(), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Keyword:index.html.twig', array('keywords' => $keys));
		*/
    }
	
	public function addAction()
    {
        
		$nature = new Nature;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new NatureType, $nature);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    
		    $em->persist($nature);
		    $em->flush();
			
			if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			{
				$tab['id'] = $nature->getId();
				$tab['designation'] = $nature->getDesignation();				
				$response = new Response(json_encode($tab));
				$response->headers->set('Content-Type', 'application/json');
				return $response;
			}
			else
			{
				return $this->redirect($this->generateUrl('erico_backend_keyword_page'));
			}
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Nature:form.html.twig', array('form_nature' => $form->createView()));
    
	}
	
	public function updateAction($id)
    {
        
		/*
		$em = $this->getDoctrine()->getManager();
		$key = $em->getRepository('EricoApiBundle:Keyword')->find($id);
		
	    $form = $this->createForm(new KeywordType, $key);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    $em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_keyword_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Keyword:form.html.twig', array('form_keyword' => $form->createView()));
		*/
		
    }
	
}