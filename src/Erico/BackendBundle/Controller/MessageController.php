<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Erico\ApiBundle\Entity\Message;
use Erico\ApiBundle\Form\MessageType;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function indexAction()
    {
		
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository('EricoApiBundle:Message')->findBy(array('archiver'=>false), array('id' => 'DESC'));
		return $this->render('EricoBackendBundle:Message:index.html.twig', array('messages' => $messages));
		
    }
	
	public function addAction()
    {
        
    
	}
	
	public function updateAction($id)
    {
        

    }
	
	public function readAction()
    {
        $response="";
		$request = $this->getRequest();
		
		$idmsg = $request->query->get('idmsg');
		$read = $request->query->get('read');
		$em = $this->getDoctrine()->getManager();
		$message = $em->getRepository('EricoApiBundle:Message')->find($idmsg);
		
		// exeception
		try{
            $message->setLecture($read);
			$em->flush();
			$response = new Response("ok");
        }catch(\Exception $e){
			
			$response = new Response($e->getMessage());
		}

		return $response;
    
	}
	
	public function showAction()
    {
        
		$response = "";
		// exeception
		try{
			$response="";
			$request = $this->getRequest();
			
			$idmsg = $request->query->get('idmsg');
			$em = $this->getDoctrine()->getManager();
			$message = $em->getRepository('EricoApiBundle:Message')->find($idmsg);
            
			$response =  new Response($message->getDescription());
        }catch(\Exception $e){
			
			$response = new Response($e->getMessage());
		}

		return $response;
    
	}
	
	
}