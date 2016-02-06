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
    
    /**
    * @Route("/admin/sostenedores/", name="sostenedores")
    */
    
    public function sostenedoresAction()
    {
        return $this->render(
            'admin/sostenedores.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/directores/", name="directores")
    */
    
    public function directoresAction()
    {
        return $this->render(
            'admin/directores.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/miembros/", name="miembros")
    */
    
    public function miembrosAction()
    {
        return $this->render(
            'admin/miembros.html.twig',
            array('params' => 1)
        );
    }
    

}