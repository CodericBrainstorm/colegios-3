<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Form\Type\SostenedorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class SostenedorController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

//    private $form_template = 'admin/sostenedores/form.html.twig';

    function __construct() {
        $this->form_template = 'admin/sostenedores/form.html.twig';
        $this->view_template = 'admin/sostenedores/view.html.twig';
    }

    /**
     * @Route("/admin/sostenedores/", name="sostenedores")
     */
    public function sostenedoresAction(Request $request) {
        $sostenedores = $this->getDoctrine()->getRepository('AppBundle:Sostenedor')->findAll();
        return $this->render(
                        'admin/sostenedores/list.html.twig', array('sostenedores' => $sostenedores)
        );
    }

    /**
     * @Route("/admin/sostenedor/", name="nuevo sostenedor")
     */
    public function nuevoSostenedorAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->createUser();

        $form = $this->createForm(SostenedorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('sostenedores');
        }
        return $this->render($this->form_template, array('title' => "sostenedor.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/sostenedor/{id}", name="editar sostenedor")
     */
    public function editarSostenedorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(SostenedorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('sostenedores');
        }

        return $this->render($this->form_template, array('title' => "sostenedor.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_sostenedor/{id}", name="ver sostenedor")
     */
    public function verSostenedorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(SostenedorType::class, $user, array('disabled' => true));
        $form->remove('plainPassword');
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array('title' => "sostenedor.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
