<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Form\Type\DirectorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class DirectorController extends Controller {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/admin/directores/", name="directores")
     */
    public function directoresAction(Request $request) {
        $directores = $this->getDoctrine()->getRepository('AppBundle:Director')->findAll();
        return $this->render(
                        'admin/directores/list.html.twig', array('directores' => $directores)
        );
    }

    /**
     * @Route("/admin/director/", name="nuevo director")
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
            return $this->redirectToRoute('directores');
        }
        return $this->render('admin/directores/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/director/{id}", name="editar director")
     */
    public function editarDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(DirectorType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userManager->updateUser($user, true);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('directores');
        }

        return $this->render('admin/directores/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        return $this->render(
                        'admin/directores/form.html.twig', array('op' => "vista",
                    'director' => $user
                        )
        );
    }

}
