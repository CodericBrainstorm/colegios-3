<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Ciudad;
use AppBundle\Form\Type\CiudadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CiudadController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/ciudades/", name="ciudades")
     */
    public function ciudadesAction(Request $request) {
        $ciudades = $this->getDoctrine()->getRepository('AppBundle:Ciudad')->findAll();
        return $this->render(
                        'admin/ciudades/list.html.twig', array('ciudades' => $ciudades)
        );
    }

    /**
     * @Route("/admin/ciudad/", name="nueva ciudad")
     */
    public function nuevaCiudadAction(Request $request) {
        $ciudad = new Ciudad();
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($ciudad);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('ciudades');
        }

        return $this->render($this->form_template, array('title' => "ciudad.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ciudad/{id}", name="editar ciudad")
     */
    public function editarCiudadAction($id, Request $request) {
        $ciudad = $this->_getObject('AppBundle:Ciudad', $id);
        $form = $this->createForm(CiudadType::class, $ciudad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('ciudades');
        }
        return $this->render($this->form_template, array('title' => "ciudad.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_ciudad/{id}", name="ver ciudad")
     */
    public function verCiudadAction($id, Request $request) {
        $ciudad = $this->_getObject('AppBundle:Ciudad', $id);
        $form = $this->createForm(CiudadType::class, $ciudad, array('disabled' => true));
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array(
                    'title' => "ciudad.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
