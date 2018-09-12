<?php

namespace Erico\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MediaController extends Controller
{
    public function indexAction()
    {
        return $this->render('EricoBackendBundle:Media:index.html.twig', array());
    }
	
	
}
