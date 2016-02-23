<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Ciudad;
use AppBundle\Form\Type\CiudadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CiudadController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/ciudades/", name="ciudades")
     */
    public function ciudadesAction(Request $request) {
        return $this->_listarObjects('AppBundle:Ciudad', 'ciudades', 'admin/ciudades/list.html.twig');
    }

    /**
     * @Route("/admin/ciudad/", name="nueva ciudad")
     */
    public function nuevaCiudadAction(Request $request) {
        return $this->_crearObject($request, Ciudad::class, CiudadType::class, 'ciudades', "ciudad", false);
    }

    /**
     * @Route("/admin/ciudad/{id}", name="editar ciudad")
     */
    public function editarCiudadAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Ciudad', CiudadType::class, 'ciudades', 'ciudad', $formOpt = array());
    }

    /**
     * @Route("/admin/ver_ciudad/{id}", name="ver ciudad")
     */
    public function verCiudadAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Ciudad', CiudadType::class, 'ciudad', $formOpt = array());
    }

}
