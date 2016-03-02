<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\SostenedorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class SostenedorController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    function __construct() {
        $this->form_template = 'admin/sostenedores/form.html.twig';
        $this->view_template = 'admin/sostenedores/view.html.twig';
    }

    /**
     * @Route("/admin/sostenedores/", name="sostenedores")
     */
    public function sostenedoresAction(Request $request) {
        return $this->_listarUsersByClass('AppBundle\Entity\Sostenedor', 'sostenedores', 'admin/sostenedores/list.html.twig');
    }

    /**
     * @Route("/admin/sostenedor/", name="nuevo sostenedor")
     */
    public function nuevoSostenedorAction(Request $request) {
        return $this->_crearUser($request, 'AppBundle\Entity\Sostenedor', SostenedorType::class, 'sostenedores', 'sostenedor');
    }

    /**
     * @Route("/admin/sostenedor/{id}", name="editar sostenedor")
     */
    public function editarSostenedorAction($id, Request $request) {
        return $this->_editarUser($request, $id, 'AppBundle\Entity\Sostenedor', SostenedorType::class, 'sostenedores', 'sostenedor');
    }

    /**
     * @Route("/admin/ver_sostenedor/{id}", name="ver sostenedor")
     */
    public function verSostenedorAction($id, Request $request) {
        return $this->_verUser($request, $id, 'AppBundle\Entity\Sostenedor', SostenedorType::class, 'sostenedor', $formOpt = array());
    }
    
    /**
     * @Route("/admin/eliminar_sostenedor/{id}", name="eliminar sostenedor")
     */
    public function eliminarSostenedorAction($id, Request $request) {
        return $this->_eliminarUser($id, 'AppBundle\Entity\Sostenedor', 'sostenedores');
    }

}
