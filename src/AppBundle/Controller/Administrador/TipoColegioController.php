<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\TipoColegio;
use AppBundle\Form\Type\TipoColegioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class TipoColegioController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/tipo_colegios/", name="tipo_colegios")
     */
    public function tipoColegiosAction(Request $request) {
        return $this->_listarObjects('AppBundle:TipoColegio', 'tipo_colegios', 'admin/tipo_colegios/list.html.twig');
    }

    /**
     * @Route("/admin/tipo_colegio/", name="nuevo tipo_colegio")
     */
    public function nuevoTipoColegioAction(Request $request) {
        return $this->_crearObject($request, TipoColegio::class, TipoColegioType::class, 'tipo_colegios', "tipo_colegio", false);
    }

    /**
     * @Route("/admin/tipo_colegio/{id}", name="editar tipo_colegio")
     */
    public function editarTipoColegioAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:TipoColegio', TipoColegioType::class, 'tipo_colegios', 'tipo_colegio', $formOpt = array());
    }

    /**
     * @Route("/admin/ver_tipo_colegio/{id}", name="ver tipo_colegio")
     */
    public function verTipoColegioAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:TipoColegio', TipoColegioType::class, 'tipo_colegio', $formOpt = array());
    }

}
