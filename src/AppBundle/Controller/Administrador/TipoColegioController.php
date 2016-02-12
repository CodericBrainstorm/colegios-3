<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\TipoColegio;
use AppBundle\Form\Type\TipoColegioType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class TipoColegioController extends Controller {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/tipo_colegios/", name="tipo_colegios")
     */
    public function tipoColegiosAction(Request $request) {
        $tipoColegios = $this->getDoctrine()->getRepository('AppBundle:TipoColegio')->findAll();
        return $this->render(
                        'admin/tipo_colegios/list.html.twig', array('tipo_colegios' => $tipoColegios)
        );
    }

    /**
     * @Route("/admin/tipo_colegio/", name="nuevo tipo_colegio")
     */
    public function nuevoTipoColegioAction(Request $request) {
        $tipoColegio = new TipoColegio();
        $form = $this->createForm(TipoColegioType::class, $tipoColegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($tipoColegio);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_colegios');
        }

        return $this->render($this->form_template, array('title' => "tipo_colegio.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/tipo_colegio/{id}", name="editar tipo_colegio")
     */
    public function editarTipoColegioAction($id, Request $request) {
        $tipoColegio = $this->_getObject('AppBundle:TipoColegio', $id);
        $form = $this->createForm(TipoColegioType::class, $tipoColegio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_colegios');
        }
        return $this->render($this->form_template, array('title' => "tipo_colegio.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_tipo_colegio/{id}", name="ver tipo_colegio")
     */
    public function verTipoColegioAction($id, Request $request) {
        $tipoColegio = $this->_getObject('AppBundle:TipoColegio', $id);
        $form = $this->createForm(TipoColegioType::class, $tipoColegio, array('disabled' => true));
        $form->handleRequest($request);
        return $this->render(
                        $this->view_template, array(
                    'title' => "tipo_colegio.views.ver.title",
                    'form' => $form->createView()
                        )
        );
    }

}
