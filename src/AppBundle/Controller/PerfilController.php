<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Security("has_role('ROLE_USER')") 
 */
class PerfilController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/{role}/perfil", name="perfil")
     */
    public function editAction($role, Request $request) {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm($user->getType(), $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager = $this->_obtenerUserManager(get_class($user));
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('perfil', array('role' => $role));
        }
        return $this->render('base_perfil.html.twig', array('title' => $role . ".views.perfil.title", 'form' => $form->createView()
        ));
    }

}
