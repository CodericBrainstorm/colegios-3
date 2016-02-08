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
            'admin/form_sostenedor.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_sostenedor/{id}", name="editar sostenedor")
    */
    
    public function editarSostenedorAction($id)
    {
        return $this->render(
            'admin/form_sostenedor.html.twig',
            array(
                'op' => "modificacion",
                'nombre' => "asd",
                'tipo_de_institucion' => "asd",
                'email' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd",
                'ciudad' => "asd",
                'comuna' => "asd",
                'direccion' => "asd"
                )
        );
    }
    
    /**
    * @Route("/admin/ver_sostenedor/{id}", name="ver sostenedor")
    */
    
    public function verSostenedorAction($id)
    {
        return $this->render(
            'admin/form_sostenedor.html.twig',
            array(
                'op' => "vista",
                'nombre' => "asd",
                'tipo_de_institucion' => "asd",
                'email' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd",
                'ciudad' => "asd",
                'comuna' => "asd",
                'direccion' => "asd"
                )
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
    * @Route("/admin/nuevo_director/", name="nuevo director")
    */
    
    public function nuevoDirectorAction()
    {
        return $this->render(
            'admin/form_director.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_director/{id}", name="editar director")
    */
    
    public function editarDirectorAction($id)
    {
        return $this->render(
            'admin/form_director.html.twig',
            array(
                'op' => "modificacion",
                'sostenedor' => "asd",
                'nombre' => "asd",
                'tipo_de_escuela' => "asd",
                'escuela' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd"
                )
        );
    }
    
    /**
    * @Route("/admin/ver_director/{id}", name="ver director")
    */
    
    public function verDirectorAction($id)
    {
        return $this->render(
            'admin/form_director.html.twig',
            array(
                'op' => "vista",
                'sostenedor' => "asd",
                'nombre' => "asd",
                'tipo_de_escuela' => "asd",
                'escuela' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd"
                )
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
    * @Route("/admin/nuevo_miembro/", name="nuevo miembro")
    */
    
    public function nuevoMiembroAction()
    {
        return $this->render(
            'admin/form_miembro.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_miembro/{id}", name="editar miembro")
    */
    
    public function editarMiembroAction($id)
    {
        return $this->render(
            'admin/form_miembro.html.twig',
            array(
                'op' => "modificacion",
                'director' => "asd",
                'nombre' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd"
                )
        );
    }
    
    /**
    * @Route("/admin/ver_miembro/{id}", name="ver miembro")
    */
    
    public function verMiembroAction($id)
    {
        return $this->render(
            'admin/form_miembro.html.twig',
            array(
                'op' => "vista",
                'director' => "asd",
                'nombre' => "asd",
                'usuario' => "asd",
                'contraseña' => "asd"
                )
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
    * @Route("/admin/nueva_rubrica/", name="nueva rubrica")
    */
    
    public function nuevaRubricaAction()
    {
        return $this->render(
            'admin/form_rubrica.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_rubrica/", name="editar rubrica")
    */
    
    public function editarRubricaAction()
    {
        return $this->render(
            'admin/form_rubrica.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_rubrica/", name="ver rubrica")
    */
    
    public function verRubricaAction()
    {
        return $this->render(
            'admin/form_rubrica.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd" 
                )
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
    * @Route("/admin/nuevo_tipo_institucion/", name="nuevo tipo de institucion")
    */
    
    public function nuevoTipoInstitucionAction()
    {
        return $this->render(
            'admin/form_tipo_institucion.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_tipo_institucion/", name="editar tipo de institucion")
    */
    
    public function editarTipoInstitucionAction()
    {
        return $this->render(
            'admin/form_tipo_institucion.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_tipo_institucion/", name="ver tipo de institucion")
    */
    
    public function verTipoInstitucionAction()
    {
        return $this->render(
            'admin/form_tipo_institucion.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd" 
                )
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
    * @Route("/admin/nueva_ciudad/", name="nueva ciudad")
    */
    
    public function nuevaCiudadAction()
    {
        return $this->render(
            'admin/form_ciudad.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_ciudad/", name="editar ciudad")
    */
    
    public function editarCiudadAction()
    {
        return $this->render(
            'admin/form_ciudad.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_ciudad/", name="ver ciudad")
    */
    
    public function verCiudadAction()
    {
        return $this->render(
            'admin/form_ciudad.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd" 
                )
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
    * @Route("/admin/nueva_comuna/", name="nueva comuna")
    */
    
    public function nuevaComunaAction()
    {
        return $this->render(
            'admin/form_comuna.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_comuna/", name="editar comuna")
    */
    
    public function editarComunaAction()
    {
        return $this->render(
            'admin/form_comuna.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd", 
                'ciudad' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_comuna/", name="ver comuna")
    */
    
    public function verComunaAction()
    {
        return $this->render(
            'admin/form_comuna.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd", 
                'ciudad' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/escuelas/", name="escuelas")
    */
    
    public function escuelasAction()
    {
        return $this->render(
            'admin/escuelas.html.twig',
            array('params' => 1)
        );
    }
    
    /**
    * @Route("/admin/nueva_escuela/", name="nueva escuela")
    */
    
    public function nuevaEscuelaAction()
    {
        return $this->render(
            'admin/form_escuela.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_escuela/", name="editar escuela")
    */
    
    public function editarEscuelaAction()
    {
        return $this->render(
            'admin/form_escuela.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd", 
                'comuna' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_escuela/", name="ver escuela")
    */
    
    public function verEscuelaAction()
    {
        return $this->render(
            'admin/form_escuela.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd", 
                'comuna' => "asd" 
                )
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
    
    /**
    * @Route("/admin/nueva_area/", name="nueva area")
    */
    
    public function nuevaAreaAction()
    {
        return $this->render(
            'admin/form_area.html.twig',
            array('op' => "alta")
        );
    }
    
    /**
    * @Route("/admin/editar_area/", name="editar area")
    */
    
    public function editarAreaAction()
    {
        return $this->render(
            'admin/form_area.html.twig',
            array(
                'op' => "modificacion", 
                'nombre' => "asd" 
                )
        );
    }
    
    /**
    * @Route("/admin/ver_area/", name="ver area")
    */
    
    public function verAreaAction()
    {
        return $this->render(
            'admin/form_area.html.twig',
            array(
                'op' => "vista", 
                'nombre' => "asd" 
                )
        );
    }
    

}