<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $user = $this->_getSostenedor();
        $directores = $user->getDirectores();
        return $this->render(
                        'sostenedor/directores/list.html.twig', array('directores' => $directores, 'sostenedor' => $user)
        );
    }

    /**
     * @Route("/sostenedor/director/", name="nuevo director sostenedor")
     */
    public function nuevoDirectorAction(Request $request) {
        $sostenedor = $this->_getSostenedor();
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->createUser();
        $user->setSostenedor($sostenedor);
        $form = $this->createForm(DirectorType::class, $user, array('disabledSostenedor' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores sostenedor');
        }
        return $this->render($this->form_template, array('title' => "director.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/sostenedor/director/{id}", name="editar director sostenedor")
     */
    public function editarDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm(DirectorType::class, $user, array('disabledSostenedor' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores sostenedor');
        }

        return $this->render($this->form_template, array('title' => "director.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted('view', $user);
        $form = $this->createForm(DirectorType::class, $user, array('disabled' => true));
        $form->remove('plainPassword');
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array('title' => "director.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

    private function _getSostenedor() {
        return $this->container->get('security.context')->getToken()->getUser();
    }

}
