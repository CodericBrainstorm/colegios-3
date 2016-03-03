<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Comuna;
use AppBundle\Form\Type\ComunaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class ComunaController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/comunas/", name="comunas")
     */
    public function comunasAction(Request $request) {
        return $this->_listarObjects('AppBundle:Comuna', 'comunas', 'admin/comunas/list.html.twig', array('borrado'=>false));
    }

    /**
     * @Route("/admin/comuna/", name="nueva comuna")
     */
    public function nuevaComunaAction(Request $request) {
        return $this->_crearObject($request, Comuna::class, ComunaType::class, 'comunas', "comuna", false);
    }

    /**
     * @Route("/admin/comuna/{id}", name="editar comuna")
     */
    public function editarComunaAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Comuna', ComunaType::class, 'comunas', 'comuna');
    }

    /**
     * @Route("/admin/ver_comuna/{id}", name="ver comuna")
     */
    public function verComunaAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Comuna', ComunaType::class, 'comuna');
    }

    /**
     * @Route("/admin/eliminar_comuna/{id}", name="eliminar comuna")
     */
    public function eliminarComunaAction($id, Request $request) {
        return $this->_borrarObjectByMethod('AppBundle:Comuna', $id, 'borrar', 'comunas');
    }

}
