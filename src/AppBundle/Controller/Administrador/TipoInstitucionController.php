<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\TipoInstitucion;
use AppBundle\Form\Type\TipoInstitucionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class TipoInstitucionController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/tipos_de_institucion/", name="tipo_instituciones")
     */
    public function tiposInstitucionAction(Request $request) {
        return $this->_listarObjects('AppBundle:TipoInstitucion', 'tipo_instituciones', 'admin/tipo_instituciones/list.html.twig', array('borrado'=>false));
    }

    /**
     * @Route("/admin/institucion/", name="nuevo tipo de institucion")
     */
    public function nuevoTipoInstitucionAction(Request $request) {
        return $this->_crearObject($request, TipoInstitucion::class, TipoInstitucionType::class, 'tipo_instituciones', "tipo_institucion", false);
    }

    /**
     * @Route("/admin/institucion/{id}", name="editar tipo de institucion")
     */
    public function editarTipoInstitucionAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:TipoInstitucion', TipoInstitucionType::class, 'tipo_instituciones', 'tipo_institucion');
    }

    /**
     * @Route("/admin/ver_tipo_institucion/{id}", name="ver tipo de institucion")
     */
    public function verTipoInstitucionAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:TipoInstitucion', TipoInstitucionType::class, 'tipo_institucion');
    }
    
    /**
     * @Route("/admin/eliminar_tipo_institucion/{id}", name="eliminar tipo de institucion")
     */
    public function eliminarTipoInstitucionAction($id, Request $request) {
        return $this->_borrarObjectByMethod('AppBundle:TipoInstitucion', $id, 'borrar', 'tipo_instituciones');
    }

}
