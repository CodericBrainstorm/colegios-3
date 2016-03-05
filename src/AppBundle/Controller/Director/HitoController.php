<?php

namespace AppBundle\Controller\Director;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Hito;
use AppBundle\Form\Type\HitoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class HitoController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait,
        \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/director/hitos/", name="hitos")
     */
    public function verHitosAsignadosAction(Request $request) {
        return $this->_listarObjects('AppBundle:Hito', 'hitos', 'director/hitos/list.html.twig', array('ano' => $this->getUser()->getAno()->getId()));
    }

    /**
     * @Route("/{role}/asignar_hito/", name="asignar hito")
     */
    public function asignarHitoAction(Request $request) {
        $director = $this->getUser();
        $config = $this->_getObject('AppBundle:Config', 1);
        return $this->_crearObjectWithAssign($request, Hito::class, HitoType::class, 'hitos', 'hito', array($director->getAno(), $config->getEstadoPredefinido(), $config->getEstadoPredefinido()), array('setAno', 'setEstadoSostenedor', 'setEstadoDirector'), array('director'=>$director));
    }

    /**
     * @Route("/director/hito_asignado/{id}", name="editar hito asignado")
     */
    public function editarHitoAsignadoAction($id, Request $request) {
        $director = $this->getUser();
        return $this->_editarObject($request, $id, 'AppBundle:Hito', HitoType::class, 'hitos', 'hito', array('director' => $director));
    }

    /**
     * @Route("/director/ver_hito_asignado/{id}", name="ver hito asignado")
     */
    public function verHitoAsignadoAction($id, Request $request) {
        $director = $this->getUser();
        return $this->_verObject($request, $id, 'AppBundle:Hito', HitoType::class, 'hito', array('director' => $director));
    }

}
