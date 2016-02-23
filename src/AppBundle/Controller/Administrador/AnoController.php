<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Ano;
use AppBundle\Form\Type\AnoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AnoController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/anos/", name="anos")
     */
    public function anosAction(Request $request) {
        return $this->_listarObjects('AppBundle:Ano', 'anos', 'admin/anos/list.html.twig');
    }

    /**
     * @Route("/admin/ano/", name="nuevo ano")
     */
    public function nuevaAnoAction(Request $request) {
        return $this->_crearObject($request, Ano::class, AnoType::class, 'anos', "ano", false);
    }

    /**
     * @Route("/admin/ano/{id}", name="editar ano")
     */
    public function editarAnoAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Ano', AnoType::class, 'anos', 'ano', $formOpt = array());
    }

}
