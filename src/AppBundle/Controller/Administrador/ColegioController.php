<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Colegio;
use AppBundle\Form\Type\ColegioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class ColegioController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/colegios/", name="colegios")
     */
    public function colegiosAction(Request $request) {
        return $this->_listarObjects('AppBundle:Colegio', 'colegios', 'admin/colegios/list.html.twig');
    }

    /**
     * @Route("/admin/colegio/", name="nuevo colegio")
     */
    public function nuevoColegioAction(Request $request) {
        return $this->_crearObject($request, Colegio::class, ColegioType::class, 'colegios', "colegio", false);
    }

    /**
     * @Route("/admin/colegio/{id}", name="editar colegio")
     */
    public function editarColegioAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Colegio', ColegioType::class, 'colegios', 'colegio');
    }

    /**
     * @Route("/admin/ver_colegio/{id}", name="ver colegio")
     */
    public function verColegioAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Colegio', ColegioType::class, 'colegio');
    }

}
