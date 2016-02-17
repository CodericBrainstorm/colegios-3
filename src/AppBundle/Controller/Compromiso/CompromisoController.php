<?php

namespace AppBundle\Controller\Compromiso;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Compromiso;
use AppBundle\Form\Type\CompromisoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CompromisoController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/compromisos/", name="compromisos")
     */
    public function compromisosAction(Request $request) {
        $compromisos = $this->getDoctrine()->getRepository('AppBundle:Compromiso')->findAll();
        return $this->render(
                        'admin/compromisos/list.html.twig', array('compromisos' => $compromisos)
        );
    }
    
    /**
     * @Route("/{role}/compromisos_sostenedor/{id}", name="ver compromisos sostenedor")
     */
    public function verCompromisosSostenedorAction($id, Request $request) {
        
        $userManager = $this->_obtenerUserManager('AppBundle\Entity\Sostenedor');
        $sostenedor = $userManager->findUserBy(array('id' => $id));
        $compromisos = $this->getDoctrine()->getRepository('AppBundle:Compromiso')->findBy(array('sostenedor' => $sostenedor));
        return $this->render(
                        'admin/compromisos/list.html.twig', array('compromisos' => $compromisos, 'sostenedor' => $sostenedor)
        );
    }

    /**
     * @Route("/admin/compromiso/", name="nuevo compromiso")
     */
    public function nuevoCompromisoAction(Request $request) {
        $compromiso = new Compromiso();
        $form = $this->createForm(CompromisoType::class, $compromiso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($compromiso);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('compromisos');
        }
        return $this->render($this->form_template, array('title' => "compromiso.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/compromiso/{id}", name="editar compromiso")
     */
    public function editarCompromisoAction($id, Request $request) {
        $compromiso = $this->_getObject('AppBundle:Compromiso', $id);
        $form = $this->createForm(CompromisoType::class, $compromiso);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('compromisos');
        }
        return $this->render($this->form_template, array('title' => "compromiso.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_compromiso/{id}", name="ver compromiso")
     */
    public function verCompromisoAction($id, Request $request) {
        $compromiso = $this->_getObject('AppBundle:Compromiso', $id);
        $form = $this->createForm(CompromisoType::class, $compromiso, array('disabled' => true));
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array(
                    'title' => "compromiso.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
