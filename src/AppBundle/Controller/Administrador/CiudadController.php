<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\Ciudad;
use AppBundle\Form\Type\CiudadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class CiudadController extends Controller {

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

        return $this->render('admin/ciudades/form.html.twig', array('op' => "alta", 'form' => $form->createView()
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
        return $this->render('admin/ciudades/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_ciudad/{id}", name="ver ciudad")
     */
    public function verCiudadAction($id, Request $request) {
        $ciudad = $this->_getObject('AppBundle:Ciudad', $id);
        return $this->render(
                        'admin/ciudades/form.html.twig', array(
                    'op' => "vista",
                    'ciudad' => $ciudad
                        )
        );
    }

}
