<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Form\Type\MiembroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class MiembroController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/{role}/miembros/", requirements={"role" = "admin|sostenedor"}, name="miembros")
     */
    public function miembrosAction(Request $request) {
        $miembros = $this->getDoctrine()->getRepository('AppBundle:Miembro')->findAll();
        return $this->render(
                        'sostenedor/miembros/list.html.twig', array('miembros' => $miembros)
        );
    }

    /**
     * @Route("/{role}/miembros/{id}", requirements={"role" = "admin|sostenedor"}, name="ver miembros director")
     */
    public function verMiembrosDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $director = $userManager->findUserBy(array('id' => $id));
        $miembros = $director->getMiembros();
        return $this->render(
                        'sostenedor/miembros/list.html.twig', array('miembros' => $miembros,
                    'director' => $director)
        );
    }

    /**
     * @Route("/{role}/{id}/miembro/{type}/{miembro_id}", requirements={"role" = "admin|sostenedor"}, defaults={"type" = "nuevo", "miembro_id" = -1}, name="nuevo miembro_director")
     */
    public function nuevoMiembroDirectorAction($id, $type, $miembro_id, Request $request) {
        $director = $this->_getDirector($id);
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        if ($type === 'nuevo') {
            $user = $userManager->createUser();
            $user->setDirector($director);
            $title = "miembro.views.new.title";
        } else {
            $user = $userManager->findUserBy(array('id' => $miembro_id));
            $this->denyAccessUnlessGranted('edit', $user);
            $title = "miembro.views.edit.title";
        }
        $form = $this->createForm(MiembroType::class, $user, array('disabledDirector' => true));
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
     * @Route("/{role}/miembro/", requirements={"role" = "admin|sostenedor"}, name="nuevo miembro")
     */
    public function nuevoMiembroAction(Request $request) {

        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->createUser();

        $form = $this->createForm(MiembroType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros');
        }
        return $this->render($this->form_template, array('title' => "miembro.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/miembro/{id}", requirements={"role" = "admin|sostenedor"}, name="editar miembro")
     */
    public function editarMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm(MiembroType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros');
        }

        return $this->render($this->form_template, array('title' => "miembro.views.edit.title", 'form' => $form->createView()
        ));
    }

    private function _getDirector($id) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $director = $userManager->findUserBy(array('id' => $id));
        return $director;
    }

}
