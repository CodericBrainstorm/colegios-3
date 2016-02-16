<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Director;

use AppBundle\Form\Type\MiembroType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class MiembroController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/{role}/miembros/", name="miembros")
     */
    public function miembrosAction(Request $request) {
        $miembros = $this->getDoctrine()->getRepository('AppBundle:Miembro')->findAll();
        return $this->render(
                        'director/miembros/list.html.twig', array('miembros' => $miembros)
        );
    }

    /**
     * @Route("/{role}/miembro/", name="nuevo miembro")
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
     * @Route("/{role}/miembro/{id}", name="editar miembro")
     */
    public function editarMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
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

    /**
     * @Route("/{role}/ver_miembro/{id}", name="ver miembro")
     */
    public function verMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(MiembroType::class, $user, array('disabled' => true));
        $form->remove('plainPassword');
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array('title' => "miembro.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
