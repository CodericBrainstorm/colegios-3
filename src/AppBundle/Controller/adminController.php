<?php 
// src/AppBundle/Controller/adminController.php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class adminController extends Controller
{
    
    /**
    * @Route("/admin/index/")
    */
    
    public function indexAction()
    {
        return $this->render(
            'admin/index.html.twig',
            array('params' => 1)
        );
    }

}