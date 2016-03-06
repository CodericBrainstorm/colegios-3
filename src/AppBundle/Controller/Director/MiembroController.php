<?php

namespace AppBundle\Controller\Director;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\MiembroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class MiembroController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/director/miembros/", name="miembros director")
     */
    public function miembrosAction(Request $request) {
        return $this->_listarUsersByOwn('getMiembrosActivos', 'miembros', 'director/miembros/list.html.twig');
    }

    /**
     * @Route("/director/miembro/", name="nuevo miembro director")
     */
    public function nuevoMiembroAction(Request $request) {
        return $this->_crearUserWithAssign($request, 'AppBundle\Entity\Miembro', MiembroType::class, 'miembros director', 'miembro', $this->getUser(), 'setDirector', array('disabledDirector' => true));
    }

    /**
     * @Route("/director/miembro/{id}", name="editar miembro director")
     */
    public function editarMiembroAction($id, Request $request) {
        return $this->_editarUser($request, $id, 'AppBundle\Entity\Miembro', MiembroType::class, 'miembros director', 'miembro', array('disabledDirector' => true));
    }

    /**
     * @Route("/{role}/ver_miembro/{id}", name="ver miembro")
     */
    public function verMiembroAction($id, Request $request) {
        return $this->_verUser($request, $id, 'AppBundle\Entity\Miembro', MiembroType::class, 'miembro', $formOpt = array());
    }
    
     /**
     * @Route("/director/eliminar_miembro/{id}", name="eliminar miembro director")
     */
    public function eliminarMiembroAction($id, Request $request) {
        return $this->_eliminarUser($id, 'AppBundle\Entity\Miembro', 'miembros director');
    }

}
