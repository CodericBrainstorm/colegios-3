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
        $user = $this->_getDirector();
        $miembros = $user->getMiembros();
        return $this->render(
                        'director/miembros/list.html.twig', array('miembros' => $miembros)
        );
    }

    /**
     * @Route("/director/miembro/", name="nuevo miembro director")
     */
    public function nuevoMiembroAction(Request $request) {
        $director = $this->_getDirector();
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->createUser();
        $user->setDirector($director);
        $form = $this->createForm(MiembroType::class, $user, array('disabledDirector' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setEnabled(true);
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros director');
        }
        return $this->render($this->form_template, array('title' => "miembro.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/director/miembro/{id}", name="editar miembro director")
     */
    public function editarMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm(MiembroType::class, $user, array('disabledDirector' => true));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('miembros director');
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
        $this->denyAccessUnlessGranted('view', $user);
        $form = $this->createForm(MiembroType::class, $user, array('disabled' => true));
        $form->remove('plainPassword');
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array('title' => "miembro.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

    private function _getDirector() {
        return $this->container->get('security.context')->getToken()->getUser();
    }

}
