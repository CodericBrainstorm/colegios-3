<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Form\Type\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Controlador;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class DirectorController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/admin/directores/", name="directores admin")
     */
    public function directoresAction(Request $request) {
        return $this->_listarUsersByClass('AppBundle\Entity\Director', 'directores', 'admin/directores/list.html.twig');
    }

    /**
     * @Route("/admin/directores/{id}", name="ver directores sostenedor admin")
     */
    public function verDirectoresSostenedorAction($id, Request $request) {
        return $this->_listarUsersByParent($id, 'getDirectores', 'directores', 'sostenedor', 'admin/directores/list.html.twig');
    }

    /**
     * @Route("/admin/{id}/director/{type}/{director_id}", defaults={"type" = "nuevo", "director_id" = -1}, name="nuevo director sostenedor admin")
     */
    public function nuevoDirectorSostenedorAction($id, $type, $director_id, Request $request) {
        if ($type === 'nuevo') {
            $sostenedor = $this->_getSostenedor($id);
            return $this->_crearUserWithAssign($request, 'AppBundle\Entity\Director', DirectorType::class, 'ver directores sostenedor admin', 'director', $sostenedor, 'setSostenedor', array('disabledSostenedor' => true), array('id' => $id));
        } else {
            return $this->_editarUser($request, $director_id, 'AppBundle\Entity\Director', DirectorType::class, 'ver directores sostenedor admin', 'director', array('disabledSostenedor' => true), array('id' => $id));
        }
    }

    /**
     * @Route("/admin/director/", name="nuevo director admin")
     */
    public function nuevoDirectorAction(Request $request) {
        return $this->_crearUser($request, 'AppBundle\Entity\Director', DirectorType::class, 'directores admin', 'director');
    }

    /**
     * @Route("/admin/director/{id}", name="editar director admin")
     */
    public function editarDirectorAction($id, Request $request) {
        return $this->_editarUser($request, $id, 'AppBundle\Entity\Director', DirectorType::class, 'directores admin', 'director');
    }

    private function _getSostenedor($id) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $sostenedor = $userManager->findUserBy(array('id' => $id));
        return $sostenedor;
    }

    /**
     * @Route("/admin/eliminar_director/{id}", name="eliminar director admin")
     */
    public function eliminarDirectorAction($id, Request $request) {
        return $this->_eliminarUser($id, 'AppBundle\Entity\Director', 'directores admin');
    }
}
