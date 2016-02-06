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
    * @Route("/admin/nuevo_sostenedor/", name="nuevo sostenedor")
    */
    
    public function nuevoSostenedorAction()
    {
        return $this->render(
            'admin/nuevo_sostenedor.html.twig',
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
    
    /**
    * @Route("/admin/rubricas/", name="rubricas")
    */
    
    public function rubricasAction()
    {
        return $this->render(
            'admin/rubricas.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/tipos_de_institucion/", name="tipos de institucion")
    */
    
    public function tiposDeInstitucionAction()
    {
        return $this->render(
            'admin/tipos_de_institucion.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/ciudades/", name="ciudades")
    */
    
    public function ciudadesAction()
    {
        return $this->render(
            'admin/ciudades.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/comunas/", name="comunas")
    */
    
    public function comunasAction()
    {
        return $this->render(
            'admin/comunas.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/areas/", name="areas")
    */
    
    public function areasAction()
    {
        return $this->render(
            'admin/areas.html.twig',
            array('params' => 1)
        );
    }
    

}