<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Attribut;
use Erico\ApiBundle\Form\AttributType;

use Symfony\Component\HttpFoundation\Response;

class AttributController extends Controller
{
    public function indexAction()
    {
		
        /*
		$em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EricoApiBundle:Produit')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Produit:index.html.twig', array('produits' => $produits));
		*/
    }
	
	public function addAction()
    {
        
		$attribut = new Attribut;
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new AttributType, $attribut);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    $em->persist($attribut);
		    $em->flush();
			
			if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			{
				$tab['id'] = $attribut->getId();
				$tab['designation'] = $attribut->getDesignation();				
								
				$response = new Response(json_encode($tab));
				$response->headers->set('Content-Type', 'application/json');
				return $response;
			}
			else
			{
				return $this->redirect($this->generateUrl('erico_backend_attribut_page'));
			}
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:Attribut:form.html.twig', array('form_attribut' => $form->createView()));
    
	}
	
	public function updateAction($id)
    {
        /*
		$em = $this->getDoctrine()->getManager();
		$produit = $em->getRepository('EricoApiBundle:Produit')->find($id);
		$declinaison = new Declinaison;
		$attribut = new Attribut;
		
		
		$form = $this->createForm(new ProduitType, $produit);
		$form_declinaison = $this->createForm(new DeclinaisonType, $declinaison);
		$form_attribut = $this->createForm(new AttributType, $attribut);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$produit->setDateModif(new \DateTime());
		    $em->flush();
			return $this->redirect($this->generateUrl('erico_backend_produit_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Produit:form.html.twig', array('form_produit' => $form->createView(), 'form_declinaison'=>$form_declinaison->createView(), 'form_attribut'=>$form_attribut->createView()));
		*/
	
    }
	
}