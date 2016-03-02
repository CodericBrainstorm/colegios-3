<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Form\Type\MiembroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use AppBundle\Controller\Controlador;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class MiembroController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/{role}/miembros/", requirements={"role" = "admin|sostenedor"}, name="miembros")
     */
    public function miembrosAction(Request $request) {
        return $this->_listarUsersByClass('AppBundle\Entity\Miembro', 'miembros', 'sostenedor/miembros/list.html.twig');
    }

    /**
     * @Route("/{role}/miembros/{id}", requirements={"role" = "admin|sostenedor"}, name="ver miembros director")
     */
    public function verMiembrosDirectorAction($id, Request $request) {
        return $this->_listarUsersByParent($id, 'getMiembros', 'miembros', 'director', 'sostenedor/miembros/list.html.twig');
    }

    /**
     * @Route("/{role}/{id}/miembro/{type}/{miembro_id}", requirements={"role" = "admin|sostenedor"}, defaults={"type" = "nuevo", "miembro_id" = -1}, name="nuevo miembro_director")
     */
    public function nuevoMiembroDirectorAction($role, $id, $type, $miembro_id, Request $request) {
        if ($type === 'nuevo') {
            $director = $this->_getDirector($id);
            return $this->_crearUserWithAssign($request, 'AppBundle\Entity\Miembro', MiembroType::class, 'ver miembros director', 'miembro', $director, 'setDirector', array('disabledDirector' => true), array('id' => $id, 'role' => $role));
        } else {
            return $this->_editarUser($request, $miembro_id, 'AppBundle\Entity\Miembro', MiembroType::class, 'ver miembros director', 'miembro', array('disabledDirector' => true), array('id' => $id, 'role' => $role));
        }
    }

    /**
     * @Route("/{role}/miembro/", requirements={"role" = "admin|sostenedor"}, name="nuevo miembro")
     */
    public function nuevoMiembroAction($role, Request $request) {
        return $this->_crearUser($request, 'AppBundle\Entity\Miembro', MiembroType::class, 'miembros', 'miembro', array(), array('role' => $role));
    }

    /**
     * @Route("/{role}/miembro/{id}", requirements={"role" = "admin|sostenedor"}, name="editar miembro")
     */
    public function editarMiembroAction($role, $id, Request $request) {
        return $this->_editarUser($request, $id, 'AppBundle\Entity\Miembro', MiembroType::class, 'miembros', 'miembro', array(), array('role' => $role));
    }

    private function _getDirector($id) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $director = $userManager->findUserBy(array('id' => $id));
        return $director;
    }
    
    /**
     * @Route("/{role}/eliminar_miembro/{id}", requirements={"role" = "admin|sostenedor"}, name="eliminar miembro")
     */
    public function eliminarMiembroAction($id, $role, Request $request) {
        return $this->_eliminarUser($id, 'AppBundle\Entity\Miembro', 'miembros', array('role'=>$role));
    }

}
