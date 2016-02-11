<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

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
     * @Route("/admin/miembros/", name="miembros")
     */
    public function miembrosAction(Request $request) {
        $miembros = $this->getDoctrine()->getRepository('AppBundle:Miembro')->findAll();
        return $this->render(
                        'admin/miembros/list.html.twig', array('miembros' => $miembros)
        );
    }

    /**
     * @Route("/admin/miembro/", name="nuevo miembro")
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
        return $this->render('admin/miembros/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/miembro/{id}", name="editar miembro")
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

        return $this->render('admin/miembros/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_miembro/{id}", name="ver miembro")
     */
    public function verMiembroAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Miembro');
        $user = $userManager->findUserBy(array('id' => $id));
        return $this->render(
                        'admin/miembros/form.html.twig', array('op' => "vista",
                    'miembro' => $user
                        )
        );
    }

}
