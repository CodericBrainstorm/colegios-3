<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\Colegio;
use AppBundle\Form\Type\ColegioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class ColegioController extends Controller {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/colegios/", name="colegios")
     */
    public function colegiosAction(Request $request) {
        $colegios = $this->getDoctrine()->getRepository('AppBundle:Colegio')->findAll();
        return $this->render(
                        'admin/colegios/list.html.twig', array('colegios' => $colegios)
        );
    }

    /**
     * @Route("/admin/colegio/", name="nuevo colegio")
     */
    public function nuevoColegioAction(Request $request) {
        $colegio = new Colegio();
        $form = $this->createForm(ColegioType::class, $colegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($colegio);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('colegios');
        }
        return $this->render('admin/colegios/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/colegio/{id}", name="editar colegio")
     */
    public function editarColegioAction($id, Request $request) {
        $colegio = $this->_getObject('AppBundle:Colegio', $id);
        $form = $this->createForm(ColegioType::class, $colegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('colegios');
        }
        return $this->render('admin/colegios/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_colegio/{id}", name="ver colegio")
     */
    public function verColegioAction($id, Request $request) {
        $colegio = $this->_getObject('AppBundle:Colegio', $id);
        return $this->render(
                        'admin/form.html.twig', array(
                    'op' => "vista",
                    'colegio' => $colegio
                        )
        );
    }

}
