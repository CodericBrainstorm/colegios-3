<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Area;
use AppBundle\Form\Type\AreaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AreaController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/areas/", name="areas")
     */
    public function areasAction(Request $request) {
        return $this->_listarObjects('AppBundle:Area', 'areas', 'admin/areas/list.html.twig', array('ano' => $this->getUser()->getAno()->getId()));
    }

    /**
     * @Route("/admin/area/", name="nueva area")
     */
    public function nuevaAreaAction(Request $request) {
        return $this->_crearObject($request, Area::class, AreaType::class, 'areas', 'area');
    }

    /**
     * @Route("/admin/area/{id}", name="editar area")
     */
    public function editarAreaAction($id, Request $request) {
        return $this->_editarObject($request, $id, 'AppBundle:Area', AreaType::class, 'areas', 'area');
    }

    /**
     * @Route("/admin/ver_area/{id}", name="ver area")
     */
    public function verAreaAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Area', AreaType::class, 'area');
    }
    
    /**
     * @Route("/admin/borrar_area/{id}", name="borrar area")
     */
    public function borrarAreaAction($id, Request $request) {
        return $this->_borrarObject('AppBundle:Area', $id, 'areas');
    }

}
