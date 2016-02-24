<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\CompromisoReal;
use AppBundle\Form\Type\CompromisoRealType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CompromisoRealController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;
    
    /**
     * @Route("/admin/compromisos_asignados_compromiso/{idCompromiso}", name="ver compromisos asignados compromiso")
     */
    public function verCompromisosAsignadosCompromisoAction($idCompromiso, Request $request) {
        return $this->_listarObjects('AppBundle:CompromisoReal', 'compromisos', 'admin/compromisosReales/list.html.twig', array('ano' => $this->getUser()->getAno()->getId(), 'compromiso'=>$idCompromiso));
    }
    
    /**
     * @Route("/admin/compromisos_asignados_sostenedor/{idSostenedor}", name="ver compromisos asignados sostenedor")
     */
    public function verCompromisosAsignadosSostenedorAction($idSostenedor, Request $request) {
        $sostenedor = $this->_obtenerUser('AppBundle\Entity\Sostenedor', $idSostenedor, 'view');
        return $this->_listarObjectsByMethod('AppBundle:CompromisoReal', 'compromisos', 'admin/compromisosReales/list.html.twig', 'findBySostenedor', array('ano'=>$this->getUser()->getAno()->getId(), 'sostenedor'=>$sostenedor));
    }

    /**
     * @Route("/admin/ver_compromiso_asignado/{id}/{idSostenedor}", name="ver compromiso asignado admin")
     */
    public function verCompromisoAsignadoAction($id, $idSostenedor, Request $request) {
        $sostenedor = $this->_obtenerUser('AppBundle\Entity\Sostenedor', $idSostenedor, 'view');
        return $this->_verObject($request, $id, 'AppBundle:CompromisoReal', CompromisoRealType::class, 'compromisoReal', array('sostenedor'=>$sostenedor, 'file_path'=>'getWebPath'));
    }

}