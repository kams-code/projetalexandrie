<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Categorie;
use Erico\ApiBundle\Form\CategorieType;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    
	public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cats = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Categorie:index.html.twig', array('categories' => $cats));
    }
	
	public function addAction()
    {
		$cat = new Categorie;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new CategorieType, $cat, array('idcat'=>0));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    $em->persist($cat);
		    $em->flush();
			
			if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			{
				$tab['id'] = $cat->getId();
				$tab['chemin'] = $cat->getChemin();				
								
				$response = new Response(json_encode($tab));
				$response->headers->set('Content-Type', 'application/json');
				return $response;
			}
			else
			{
				return $this->redirect($this->generateUrl('erico_backend_cat_page'));
			}

			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Categorie:form.html.twig', array('form_cat' => $form->createView()));
    }
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$cat = $em->getRepository('EricoApiBundle:Categorie')->find($id);
		
	    $form = $this->createForm(new CategorieType, $cat, array('idcat'=>$cat->getId()));
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
		    
			$em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_cat_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Categorie:form.html.twig', array('form_cat' => $form->createView()));
    
	}
	
	
	
	
	
}