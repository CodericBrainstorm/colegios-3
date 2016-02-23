<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class DirectorController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/sostenedor/directores/", name="directores sostenedor")
     */
    public function directoresAction(Request $request) {
        return $this->_listarUsersByOwn('getDirectores', 'directores', 'sostenedor/directores/list.html.twig');
    }

    /**
     * @Route("/sostenedor/director/", name="nuevo director sostenedor")
     */
    public function nuevoDirectorAction(Request $request) {
        return $this->_crearUserWithAssign($request, 'AppBundle\Entity\Director', DirectorType::class, 'directores sostenedor', 'director', $this->getUser(), 'setSostenedor', array('disabledSostenedor' => true));
    }

    /**
     * @Route("/sostenedor/director/{id}", name="editar director sostenedor")
     */
    public function editarDirectorAction($id, Request $request) {
        return $this->_editarUser($request, $id, 'AppBundle\Entity\Director', DirectorType::class, 'directores sostenedor', 'director', array('disabledSostenedor' => true));
    }

    /**
     * @Route("/{role}/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        return $this->_verUser($request, $id, 'AppBundle\Entity\Director', DirectorType::class, 'director');
    }

}
