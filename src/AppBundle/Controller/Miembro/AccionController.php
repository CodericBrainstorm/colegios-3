<?php

namespace AppBundle\Controller\Miembro;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Accion;
use AppBundle\Form\Type\AccionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_MIEMBRO')") 
 */
class AccionController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;
    
    /**
     * @Route("/miembro/acciones/", name="acciones")
     */
    public function verAccionesAction(Request $request) {
        return $this->_listarObjects('AppBundle:Accion', 'acciones', 'miembro/acciones/list.html.twig', array('ano' => $this->getUser()->getAno()->getId()));
    }

    /**
     * @Route("/miembro/nueva_accion/", name="nueva accion")
     */
    public function nuevaAccionAction(Request $request) {
        $config = $this->_getObject('AppBundle:Config', 1);
        return $this->_crearObjectWithAssign($request, Accion::class, AccionType::class, 'acciones', 'accion', array($this->getUser(), $config->getEstadoPredefinido(), $config->getEstadoPredefinido()), array('setMiembro', 'setEstadoDirector', 'setEstadoMiembro'), array('miembro'=>$this->getUser(), 'ano'=>$this->getUser()->getAno(), 'readonlyMiembro'=>true, 'readonlyEstadoDirector' => true));
    }

    /**
     * @Route("/miembro/editar_accion/{id}", name="editar accion")
     */
    public function editarAccionAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Accion', AccionType::class, 'acciones', 'accion', array('miembro'=>$this->getUser(), 'ano'=>$this->getUser()->getAno(), 'readonlyEstadoDirector' => true));
    }

    /**
     * @Route("/miembro/ver_accion/{id}", name="ver accion")
     */
    public function verAccionAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Accion', AccionType::class, 'accion', array('miembro'=>$this->getUser(), 'ano'=>$this->getUser()->getAno(), 'disabled'=>true));
    }
    
    /**
     * @Route("/miembro/eliminar_accion/{id}", name="eliminar accion")
     */
    public function borrarAccionAction($id, Request $request) {
        return $this->_borrarObject('AppBundle:Accion', $id, 'acciones');
    }

}