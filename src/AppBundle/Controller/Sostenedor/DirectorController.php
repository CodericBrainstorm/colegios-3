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
     * @Route("/{role}/directores/", name="directores")
     */
    public function directoresAction(Request $request) {
        $directores = $this->getDoctrine()->getRepository('AppBundle:Director')->findAll();
        return $this->render(
                        'sostenedor/directores/list.html.twig', array('directores' => $directores)
        );
    }
    
    /**
     * @Route("/{role}/directores_sostenedor/{id}", name="ver directores sostenedor")
     */
    public function verDirectoresSostenedorAction($id, Request $request) {
        
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $sostenedor = $userManager->findUserBy(array('id' => $id));
        $directores = $this->getDoctrine()->getRepository('AppBundle:Director')->findBy(array('sostenedor' => $sostenedor));
        $nombre_sostenedor = $sostenedor->getNombre() . " " . $sostenedor->getApellido();
        return $this->render(
                        'sostenedor/directores/list.html.twig', array('directores' => $directores, 'nombre_sostenedor' => $nombre_sostenedor)
        );
    }

    /**
     * @Route("/{role}/director/", name="nuevo director")
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
        return $this->render($this->form_template, array('title' => "director.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/director/{id}", name="editar director")
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

        return $this->render($this->form_template, array('title' => "director.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/ver_director/{id}", name="ver director")
     */
    public function verDirectorAction($id, Request $request) {
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Director');
        $user = $userManager->findUserBy(array('id' => $id));
        $form = $this->createForm(DirectorType::class, $user, array('disabled' => true));
        $form->remove('plainPassword');
        return $this->render(
                        $this->view_template, array('title' => "director.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
