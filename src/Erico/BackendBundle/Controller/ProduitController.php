<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Produit;
use Erico\ApiBundle\Form\ProduitType;
use Erico\ApiBundle\Entity\Declinaison;
use Erico\ApiBundle\Form\DeclinaisonType;
use Erico\ApiBundle\Entity\Attribut;
use Erico\ApiBundle\Form\AttributType;

use Symfony\Component\HttpFoundation\Response;

class ProduitController extends Controller
{
    public function indexAction()
    {
		
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EricoApiBundle:Produit')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Produit:index.html.twig', array('produits' => $produits));
		
    }
	
	public function addAction()
    {
        $produit = new Produit;
		$declinaison = new Declinaison;
		$attribut = new Attribut;
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new ProduitType, $produit, array('idprod'=>0));
		$form_declinaison = $this->createForm(new DeclinaisonType, $declinaison);
		$form_attribut = $this->createForm(new AttributType, $attribut);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    
		    $em->persist($produit);
		    $em->flush();
			
			
			return $this->redirect($this->generateUrl('erico_backend_produit_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Produit:form.html.twig', array('form_produit' => $form->createView(), 'form_declinaison'=>$form_declinaison->createView(), 'form_attribut'=>$form_attribut->createView()));
    
	}
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$produit = $em->getRepository('EricoApiBundle:Produit')->find($id);
		$declinaison = new Declinaison;
		$attribut = new Attribut;
		
		
		$form = $this->createForm(new ProduitType, $produit, array('idprod'=>$produit->getId()));
		$form_declinaison = $this->createForm(new DeclinaisonType, $declinaison);
		$form_attribut = $this->createForm(new AttributType, $attribut);
		
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			// la relation inverse produit dans l'entité déclinaison n'est pas pris en compte automatiquement lors du flush il faut le faire manuellement
			$olddecli = $em->getRepository('EricoApiBundle:Declinaison')->findBy(array('produit'=>$produit->getId()), array());
			
			// on supprime les anciennes declinaison qui ne sont plus affecté
			$temp = array();
			foreach($produit->getDeclinaisons() as $elem)
			{
				$temp[] = $elem->getId();
			}
			
			foreach($olddecli as $elem){
				if(!in_array($elem->getId(), $temp))
				$em->remove($elem); 
			}
			
			//on save les nouvelles declinaison
			foreach($produit->getDeclinaisons() as $elem){
				$elem->setProduit($produit);
			}
			
			$produit->setDateModif(new \DateTime());
		    $em->flush();
			return $this->redirect($this->generateUrl('erico_backend_produit_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Produit:form.html.twig', array('form_produit' => $form->createView(), 'form_declinaison'=>$form_declinaison->createView(), 'form_attribut'=>$form_attribut->createView()));


    }
	
}