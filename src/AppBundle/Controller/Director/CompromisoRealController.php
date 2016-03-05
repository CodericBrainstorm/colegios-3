<?php

namespace AppBundle\Controller\Director;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\CompromisoReal;
use AppBundle\Form\Type\CompromisoRealDirectorType;
use AppBundle\Form\Type\CompromisoRealType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class CompromisoRealController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;
    
    /**
     * @Route("/director/compromisos_asignados_director/", name="ver compromisos asignados director")
     */
    public function verCompromisosAsignadosAction(Request $request) {
        $director = $this->getUser();
        return $this->_listarObjects('AppBundle:CompromisoReal', 'compromisos', 'director/compromisosReales/list.html.twig', array('ano' => $this->getUser()->getAno()->getId(), 'director'=>$director));
    }
    
    /**
     * @Route("/director/ver_compromiso_asignado/{id}/{idSostenedor}", name="ver compromiso asignado director")
     */
    public function verCompromisoAsignadoAction($id, $idSostenedor, Request $request) {
        $sostenedor = $this->getUser()->getSostenedor();
        return $this->_verObject($request, $id, 'AppBundle:CompromisoReal', CompromisoRealType::class, 'compromisoReal', array('sostenedor'=>$sostenedor, 'file_path'=>'getWebPath', 'ano'=>$this->getUser()->getAno()));
    }

    /**
     * @Route("/director/compromiso_asignado/{id}/{idSostenedor}", name="editar compromiso asignado director")
     */
    public function editarCompromisoAsignadoAction($id, $idSostenedor, Request $request) {
        $sostenedor = $this->getUser()->getSostenedor();
        return $this->_editarObject($request, $id, 'AppBundle:CompromisoReal', CompromisoRealDirectorType::class, 'ver compromisos asignados director', 'compromisoReal', array('sostenedor'=>$sostenedor, 'file_path'=>'getWebPath'));
    }
}