<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Jurisprudence;
use Erico\ApiBundle\Form\JurisprudenceType;

class JurisprudenceController extends Controller
{
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $jurisprudences = $em->getRepository('EricoApiBundle:Jurisprudence')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		
        return $this->render('EricoBackendBundle:Jurisprudence:index.html.twig', array('jurisprudences' => $jurisprudences));
    }
	
	public function addAction()
    {
		$em = $this->getDoctrine()->getManager();

		$jurisprudence = new Jurisprudence;
	    $form = $this->createForm(new JurisprudenceType, $jurisprudence);
		
		$repository = $em->getRepository('EricoApiBundle:Jurisprudence');
		$jurisprudences = $repository->findAllJuridiction();
		$sections = $repository->findAllsection();
	    
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			  
		    $em->persist($jurisprudence);
		    $em->flush();
			
		    return $this->redirect($this->generateUrl('erico_backend_jurisprudence_page'));
			
		  }
		  
		  
	    }
		  
        return $this->render('EricoBackendBundle:Jurisprudence:form.html.twig', array('form_jurisprudence' => $form->createView(), 'jurisprudences'=>$jurisprudences, 'sections'=>$sections));
		
    }
	
	public function updateAction($id)
    {
		// recherche de l'entite
		$em = $this->getDoctrine()->getManager();
		$repository = $em->getRepository('EricoApiBundle:Jurisprudence');
		$jurisprudence = $repository->find($id);	
		$jurisprudences = $repository->findAllJuridiction();
		$sections = $repository->findAllsection();
		
		$form = $this->createForm(new JurisprudenceType, $jurisprudence);
		
		$request = $this->get('request');
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if ($form->isValid()) {
			$jurisprudence->setDateModif(new \DateTime());
		    $em->flush();
		    return $this->redirect($this->generateUrl('erico_backend_jurisprudence_page'));
		  }
		  
	    }
		
		
        return $this->render('EricoBackendBundle:Jurisprudence:form.html.twig', array('form_jurisprudence' => $form->createView(), 'jurisprudences'=>$jurisprudences, 'sections'=>$sections));
    }
	
	
	
}
