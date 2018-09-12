<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Abonnement;
use Erico\ApiBundle\Form\AbonnementType;


use Symfony\Component\HttpFoundation\Response;

class AbonnementController extends Controller
{
    public function indexAction()
    {
		
        $em = $this->getDoctrine()->getManager();
        $abonnements = $em->getRepository('EricoApiBundle:Abonnement')->findBy(array(), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Abonnement:index.html.twig', array('abonnements' => $abonnements));
		
    }
	
	public function addAction()
    {
        $abonnement = new Abonnement;
		
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new AbonnementType, $abonnement);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
		    
		    $em->persist($abonnement);
		    $em->flush();
			
			
			return $this->redirect($this->generateUrl('erico_backend_abonnement_page'));
			
		    
		  }
		  
		  
	    }
		  
		return $this->render('EricoBackendBundle:Abonnement:form.html.twig', array('form_abonnement' => $form->createView()));
    
	}
	
	public function updateAction($id)
    {
        
		$em = $this->getDoctrine()->getManager();
		$abonnement= $em->getRepository('EricoApiBundle:Abonnement')->find($id);
		
		$form = $this->createForm(new AbonnementType, $abonnement);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
			$request = $this->get('request');
			
			if ($request->getMethod() == 'POST') {
			  
			  $form->bind($request);
			  
			  if($form->isValid()) {
				
				$em->flush();
				
				return $this->redirect($this->generateUrl('erico_backend_abonnement_page'));
				
			  }
			  
			}
		}
		  
		return $this->render('EricoBackendBundle:Abonnement:form.html.twig', array('form_abonnement' => $form->createView()));
    
    }
	
}