<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Document;
use Erico\ApiBundle\Form\DocumentType;

class DocumentController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $documents = $em->getRepository('EricoApiBundle:Document')->findBy(array('archiver'=>false), array('id' => 'DESC'));
        return $this->render('EricoBackendBundle:Document:index.html.twig', array('documents' => $documents));
    }
	
	public function addAction()
    {
		
		
		$document = new Document;
	    $form = $this->createForm(new DocumentType, $document);
	    
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			  
		    $em = $this->getDoctrine()->getManager();
		    $em->persist($document);
		    $em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_document_page'));
			
		  }
		  
	    }
		  
        return $this->render('EricoBackendBundle:Document:form.html.twig', array('form_document' => $form->createView()));
		
    }
	
	public function updateAction($id)
    {
		// recherche de l'entite
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('EricoApiBundle:Document');
		$document = $repository->find($id);		
		
		$form = $this->createForm(new DocumentType, $document);
		
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if ($form->isValid()) {
			$document->setDateModif(new \DateTime());
		    $em->flush();
		    return $this->redirect($this->generateUrl('erico_backend_document_page'));
		  }
		  
	    }
		
		
        return $this->render('EricoBackendBundle:Document:form.html.twig', array('form_document' => $form->createView()));
    }
	
	
	
}
