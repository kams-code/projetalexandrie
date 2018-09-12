<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Setting;
use Erico\ApiBundle\Form\SettingType;
use Symfony\Component\HttpFoundation\Response;
use Erico\ApiBundle\Entity\AppSetting;
use Erico\ApiBundle\Form\AppSettingType;

class SettingController extends DefaultController
{
    
	/*public function allAction()
    {
		$chaine = file_get_contents('parametres.txt');
		$tab = unserialize($chaine);
		
		if ( file_exists('parametres.txt')) {
		
			chmod('parametres.txt', 0777);
		}
		
		$tab['id'] = 10;
		$tab['chemin'] = "bonjour";				
						
		$response = serialize ($tab);
		
				
		file_put_contents('parametres.txt', $response);
		
		//$this->setParameter('nomParametre', 'dghfh');
		return $this->render('EricoBackendBundle:Setting:index.html.twig', array());
	}*/
	
	
	public function allAction()
    {
		$setting = $this->config();
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new SettingType, $setting);
		
		$em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository('EricoApiBundle:Categorie')->findBy(array('archiver'=>false), array('designation' => 'ASC'));
		$menus = $em->getRepository('EricoApiBundle:Menu')->findBy(array('archiver'=>false), array('designation' => 'ASC'));

		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$setting->save();
		    
			if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			{
				$response = new Response("ok");
				return $response;
			}
			
			//return $this->redirect($this->generateUrl('erico_backend_homepage'));
			
		  }
		  
		  
		  
	    }
		
		return $this->render('EricoBackendBundle:Setting:index.html.twig', array('form_setting' => $form->createView(), 'categories'=>$cat, 'menus'=>$menus, 'setting'=>$setting));
    
	}
	
	
	public function appAction()
    {
		$setting = $this->appconfig();
		
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new AppSettingType, $setting);
		
		$em = $this->getDoctrine()->getManager();

		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$setting->save();
		    
			if( $request->isXmlHttpRequest() ) //on si la requête est en AJAX
			{
				$response = new Response("ok");
				return $response;
			}
			
			//return $this->redirect($this->generateUrl('erico_backend_homepage'));
			
		  }
		  
		  
		  
	    }
		
		return $this->render('EricoBackendBundle:Setting:app.html.twig', array('form_setting' => $form->createView(), 'setting'=>$setting));
    
	}
	
	
	
}
