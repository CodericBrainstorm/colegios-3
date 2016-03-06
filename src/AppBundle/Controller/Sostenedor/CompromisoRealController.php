<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\CompromisoReal;
use AppBundle\Form\Type\CompromisoRealType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class CompromisoRealController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait,
        \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/sostenedor/compromisos_asignados/", name="ver compromisos asignados")
     */
    public function verCompromisosAsignadosAction(Request $request) {
        return $this->_listarObjects('AppBundle:CompromisoReal', 'compromisos', 'sostenedor/compromisosReales/list.html.twig', array('ano' => $this->getUser()->getAno()->getId()));
    }

    /**
     * @Route("/sostenedor/compromisos_asignados/{id}", name="ver compromisos asignados un director")
     */
    public function verCompromisosDirectorAction($id, Request $request) {
        return $this->_listarUsersByParent($id, 'getCompromisos', 'compromisos', 'director', 'sostenedor/compromisosReales/list.html.twig');
    }

    /**
     * @Route("/sostenedor/compromisos_asignados/{director}/hitos/{id}", name="ver hitos compromiso director")
     */
    public function verHitosCompromisosDirectorAction($director, $id, Request $request) {
        $directorUser = $this->_obtenerUser('AppBundle\Entity\Director', $director, 'view');
        $compromiso = $this->_getObject('AppBundle:CompromisoReal', $id);
        return $this->_listarObjects('AppBundle:Hito', 'hitos', 'director/hitos/list.html.twig', array('compromiso' => $id, 'ano' => $this->getUser()->getAno()->getId()), array('compromiso' => $compromiso, 'director' => $directorUser));
    }

    /**
     * @Route("/sostenedor/asignar_compromiso/", name="asignar compromiso")
     */
    public function asignarCompromisoAction(Request $request) {
        $sostenedor = $this->getUser();
        $config = $this->_getObject('AppBundle:Config', 1);
        return $this->_crearObjectWithAssign($request, CompromisoReal::class, CompromisoRealType::class, 'ver compromisos asignados', 'compromisoReal', array($sostenedor->getAno(), $config->getEstadoPredefinido(), $config->getEstadoPredefinido()), array('setAno', 'setEstadoSostenedor', 'setEstadoDirector'), array('sostenedor'=>$sostenedor, 'ano'=>$this->getUser()->getAno(), 'readonlyEstadoDirector'=>true));

    }

    /**
     * @Route("/sostenedor/compromiso_asignado/{id}", name="editar compromiso asignado")
     */
    public function editarCompromisoAsignadoAction($id, Request $request) {
        $sostenedor = $this->getUser();
        return $this->_editarObject($request, $id, 'AppBundle:CompromisoReal', CompromisoRealType::class, 'ver compromisos asignados', 'compromisoReal', array('sostenedor' => $sostenedor, 'file_path' => 'getWebPath', 'ano' => $this->getUser()->getAno(), 'read_only_estado_director' => true));
    }

    /**
     * @Route("/sostenedor/ver_compromiso_asignado/{id}", name="ver compromiso asignado")
     */
    public function verCompromisoAsignadoAction($id, Request $request) {
        $sostenedor = $this->getUser();
        return $this->_verObject($request, $id, 'AppBundle:CompromisoReal', CompromisoRealType::class, 'compromisoReal', array('sostenedor' => $sostenedor, 'file_path' => 'getWebPath', 'ano' => $this->getUser()->getAno()));
    }

    /**
     * @Route("/sostenedor/borrar_compromiso_asignado/{id}", name="borrar compromiso asignado")
     */
    public function borrarCompromisoRealAction($id, Request $request) {
        return $this->_borrarObject('AppBundle:CompromisoReal', $id, 'ver compromisos asignados');
    }

}
