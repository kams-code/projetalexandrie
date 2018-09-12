<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\User;
use Erico\ApiBundle\Form\UserType;
use Erico\ApiBundle\Form\RegisterType;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;

class UserController extends DefaultController
{
    
	public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('EricoApiBundle:User')->findBy(array(), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:User:index.html.twig', array('users'=>$users));
	}
	
	public function addAction()
    {
        
		$user = new User;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new UserType, $user);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$factory = $this->container->get('security.encoder_factory');
			$encoder = $factory->getEncoder($user);
			$user->encodePassword($encoder);
			
		    $em->persist($user);
		    $em->flush();
			
			return $this->redirect($this->generateUrl('erico_backend_user_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:User:form.html.twig', array('form_user' => $form->createView()));
    
	}
	
	
	public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
		
		$user = $em->getRepository('EricoApiBundle:User')->find($id);
		
	    $form = $this->createForm(new UserType, $user);
		
		$request = $this->get('request');
		
	    if ($request->getMethod() == 'POST') {
		  
		  $form->bind($request);
		  
		  if($form->isValid()) {
			
			$factory = $this->container->get('security.encoder_factory');
			$encoder = $factory->getEncoder($user);
			$user->encodePassword($encoder);
			
		    $em->flush();
			
			return $this->redirect($this->generateUrl('erico_backend_user_page'));
			
		  }
		  
	    }
		  
		return $this->render('EricoBackendBundle:User:form.html.twig', array('form_user' => $form->createView()));
    
	}
	
	
	public function deleteAction()
    {
		$response="";
		$request = $this->getRequest();
		
		$iduser = $request->query->get('iduser');
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('EricoApiBundle:User')->find($iduser);
		
		// exeception
		try{
            $em->remove($user );
			$em->flush();
			$response = new Response("ok");
        }catch(\Exception $e){
			
			$response = new Response($e->getMessage());
		}

		return $response;
	}
	
	
	public function loginAction()
    {
		
		//activation de l'authentification pour le gestionnaire de fichier
		$_SESSION['authen'] = 1;
		
		
		// Si le visiteur est déjà identifié, on le redirige vers l'accueil
		
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
				
			// mise à jour de la session important pour les pages qui ne requiet pas d'authentification car impossible d'accéder aux informations d'authenltification
			/*if($this->getUser()->getUsername() != $this->getParameter('super_admin'))
			return $this->redirect($this->generateUrl('cud_default_indexpage'));
			else*
			return $this->redirect($this->generateUrl('cud_default_adminpage'));
			*/
			return $this->redirect($this->generateUrl('alexandrie_frontend_homepage'));
		}
		
		$request = $this->getRequest();
		$session = $request->getSession();
		// On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
		  $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
		  $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
		  $session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}
		
		
		
		$user = new User;
		$em = $this->getDoctrine()->getManager();
		
	    $form = $this->createForm(new RegisterType, $user);
		$setting = $this->config();
		
		return $this->render('AlexandrieFrontendBundle:Default:login.html.twig',array(
		  // Valeur du précédent nom d'utilisateur entré parl'internaute
		  'last_username' => $session->get(SecurityContext::LAST_USERNAME),
		  'error'         => $error,
		  'form_user' => $form->createView(),
		  'setting'=>$setting));
		
		
		//return $this->render('LegiafricaFrontendBundle:Default:login.html.twig',array());
    }
	
	public function registerAction()
    {
		$setting = $this->config();
		
		$user = new User;
		
	    $form = $this->createForm(new RegisterType, $user);
		
		$request = $this->get('request');
		
		$em = $this->getDoctrine()->getManager();
		  
		$form->bind($request);
		  
		if($form->isValid()) {
			
			//verification email
			$rep = $em->getRepository('EricoApiBundle:User')->findOneBy(array('email'=>$user->getEmail()));
			
			if($rep == null)
			{
				//verification nom d utilisateur
				$rep = $em->getRepository('EricoApiBundle:User')->findOneBy(array('username'=>$user->getUsername()));
				
				if($rep == null)
				{
					$factory = $this->container->get('security.encoder_factory');
					$encoder = $factory->getEncoder($user);
					$user->encodePassword($encoder);
					$user->setIsActive(true);
					
					$em->persist($user);
					$em->flush();
					
					/* // Récupération du service
					$mailer = $this->get('mailer');
					
					// Création de l'e-mail : le service mailer utilise SwiftMailer, donc nous créons une instance de Swift_Message
					$message = \Swift_Message::newInstance()
						  ->setSubject($user->getUsername().' Dernière étape...')
						  ->setFrom($user->getEmail())
						  ->setTo('paulyemdji@gmail.com')
						  ->setBody('<div>
									<h1>Dernière étape...</h1>
									<div>Confirmez votre adresse email (<span style="color:blue">'.$user->getEmail().'</span>) afin de finaliser votre inscription sur www.legiafrica.com. C\'est simple — cliquez simplement sur le bouton ci-dessous.</div><br/>
									<div><a href="'.$this->generateUrl('legiafrica_frontend_homepage', array(), true).'" style="display:block; padding:10px; background:#bb1310; color:white; font-size:16px; width:180px; border-radius:5px;">Confirmer maintenant</a></div>
									</div>', 'text/html');
									
					//pour envoyer notre $message
					$mailer->send($message); */
					
					if( $setting->getEmail() !="" )
					{
						// Récupération du service
						$mailer = $this->get('mailer');
						
						// Création de l'e-mail : le service mailer utilise SwiftMailer, donc nous créons une instance de Swift_Message
						$swiftmessage = \Swift_Message::newInstance()
							  ->setSubject('Inscription d’un nouvel utilisateur : '.$user->getUsername())
							  ->setFrom(array($this->getParameter('mailer_user') => 'legiafrica.com'))
							  ->setTo($setting->getEmail())
							  ->setBody('<div>
										Identifiant : '.$user->getUsername().'<br/>
										Email : '.$user->getEmail().'<br/>
										</div>', 'text/html');
										
						//pour envoyer notre $message
						$mailer->send($swiftmessage);
						
					}
					
					$response = new Response("ok");
					
					
				}
				else
				{
					$response = new Response("nom d'utilisateur déjà utilisé");
				}
				
			}
			else
			{
				
				if ($rep->getIsActive() == false and $rep->getNewletter() == true){
				
					$rep->setUsername($user->getUsername());
					$rep->setName($user->getName());
					$rep->setPassword($user->getPlainPassword());
					$factory = $this->container->get('security.encoder_factory');
					$encoder = $factory->getEncoder($rep);
					$rep->encodePassword($encoder);
					$rep->setIsActive(true);
					$em->flush();
					$response = new Response("ok");
				}
				else
				{
					$response = new Response("Adresse email déjà utilisé");
				}
				
			}
			
		}
		else
		{
			$response = new Response("formulaire non validé");
		}
		
		return $response;
		
	}
	
	public function newLetterRegisterAction()
    {
		
		$request = $this->getRequest();
		
		$email = $request->request->get('mail');
		$nom = $request->request->get('nom');
		
		$em = $this->getDoctrine()->getManager();
		
		$repository = $em->getRepository('EricoApiBundle:User');
		
		$user = $repository->findOneBy(array('email' => $email));
		
		$message = "";
		
		
		if ($user == null)
		{
			
			$user = new User();
		
			$user->setEmail($email);
			$user->setName($nom);
			
			$user->setNewletter(true);
		
			$em->persist($user);
			
			$em->flush();
			
			$message = $user->getName()." Merçi pour votre inscription et à bientôt";
			
		}
		else
		{
			
			
			if ($user->getIsactive()){
				
				$user->setNewletter(true);
				$em->flush();
				$message = "Cet adresse email est déjà utilisé par un compte : s'il s'agit de votre compte, connectez-vous et accéder à votre espace abonné pour activer ou désactiver la newsletter";

			}
			else
			{
				
				if ($user->getNewletter() == false ){
				
					$user->setNewletter(true);
					$user->setName($nom);
					$em->flush();
					$message = "Merçi pour votre inscription et à bientôt";
				}
				else
				{
					$message = "Vous êtes déjà inscrit à notre newsletter ! merçi et à bientôt";
				}
				
			}
			
			
			
		}
		
		return new Response($message);
		
		//return new Response('votre compte à été créer avec success. Un mail vous a été envoyé à l\'adresse : '.$email.' vérifier le mail pour activer votre compte');
    
	}
	
	
	
}
