<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Compromiso;
use AppBundle\Form\Type\CompromisoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CompromisoController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/compromisos/", name="compromisos")
     */
    public function compromisosAction(Request $request) {
        return $this->_listarObjects('AppBundle:Compromiso', 'compromisos', 'admin/compromisos/list.html.twig', array('ano' => $this->getUser()->getAno()->getId()));
    }
    
    /**
     * @Route("/admin/compromisos_sostenedor/{id}", name="ver compromisos sostenedor")
     */
    public function verCompromisosSostenedorAction($id, Request $request) {
        $sostenedor = $this->_obtenerUser('AppBundle\Entity\Sostenedor', $id, 'view');
        return $this->_listarObjects('AppBundle:Compromiso', 'compromisos', 'admin/compromisos/list.html.twig', array('ano' => $this->getUser()->getAno()->getId(), 'sostenedor'=>$sostenedor));
    }

    /**
     * @Route("/admin/compromiso/", name="nuevo compromiso")
     */
    public function nuevoCompromisoAction(Request $request) {
        return $this->_crearObject($request, Compromiso::class, CompromisoType::class, 'compromisos', 'compromiso');
    }

    /**
     * @Route("/admin/compromiso/{id}", name="editar compromiso")
     */
    public function editarCompromisoAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Compromiso', CompromisoType::class, 'compromisos', 'compromiso', array());
    }

    /**
     * @Route("/admin/ver_compromiso/{id}", name="ver compromiso")
     */
    public function verCompromisoAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Compromiso', CompromisoType::class, 'compromiso', array('disabled'=>true));
    }

}
