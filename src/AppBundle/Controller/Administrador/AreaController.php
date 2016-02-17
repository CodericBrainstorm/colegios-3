<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Area;
use AppBundle\Form\Type\AreaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AreaController extends Controlador {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/areas/", name="areas")
     */
    public function areasAction(Request $request) {
        $areas = $this->getDoctrine()->getRepository('AppBundle:Area')->findAll();
        return $this->render(
                        'admin/areas/list.html.twig', array('areas' => $areas)
        );
    }

    /**
     * @Route("/admin/area/", name="nueva area")
     */
    public function nuevaAreaAction(Request $request) {
        $area = new Area();
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($area);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('areas');
        }
        return $this->render($this->form_template, array('title' => "area.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/area/{id}", name="editar area")
     */
    public function editarAreaAction($id, Request $request) {
        $area = $this->_getObject('AppBundle:Area', $id);
        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('areas');
        }
        return $this->render($this->form_template, array('title' => "area.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_area/{id}", name="ver area")
     */
    public function verAreaAction($id, Request $request) {
        $area = $this->_getObject('AppBundle:Area', $id);
        $form = $this->createForm(AreaType::class, $area, array('disabled' => true));
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array(
                    'title' => "area.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
