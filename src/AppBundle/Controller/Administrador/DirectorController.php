<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Form\Type\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class DirectorController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/admin/directores/", name="directores admin")
     */
    public function directoresAction(Request $request) {
        $directores = $this->getDoctrine()->getRepository('AppBundle:Director')->findAll();
        return $this->render(
                        'admin/directores/list.html.twig', array('directores' => $directores)
        );
    }

    /**
     * @Route("/admin/directores/{id}", name="ver directores sostenedor admin")
     */
    public function verDirectoresSostenedorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $sostenedor = $userManager->findUserBy(array('id' => $id));
        $directores = $sostenedor->getDirectores();
        return $this->render(
                        'admin/directores/list.html.twig', array('directores' => $directores,
                    'sostenedor' => $sostenedor)
        );
    }

    /**
     * @Route("/admin/{id}/director/{type}/{director_id}", defaults={"type" = "nuevo", "director_id" = -1}, name="nuevo director sostenedor admin")
     */
    public function nuevoDirectorSostenedorAction($id, $type, $director_id, Request $request) {
        $sostenedor = $this->_getSostenedor($id);
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        if ($type === 'nuevo') {
            $user = $userManager->createUser();
            $user->setSostenedor($sostenedor);
            $title = "director.views.new.title";
        } else {
            $user = $userManager->findUserBy(array('id' => $director_id));
            $this->denyAccessUnlessGranted('edit', $user);
            $title = "director.views.edit.title";
        }
        $form = $this->createForm(DirectorType::class, $user, array('disabledSostenedor' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores');
        }
        return $this->render($this->form_template, array('title' => $title, 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/director/", name="nuevo director admin")
     */
    public function nuevoDirectorAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->createUser();

        $form = $this->createForm(DirectorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores admin');
        }
        return $this->render($this->form_template, array('title' => "director.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/director/{id}", name="editar director admin")
     */
    public function editarDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm(DirectorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores admin');
        }

        return $this->render($this->form_template, array('title' => "director.views.edit.title",
                    'form' => $form->createView()
        ));
    }

    private function _getSostenedor($id) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $sostenedor = $userManager->findUserBy(array('id' => $id));
        return $sostenedor;
    }

}
