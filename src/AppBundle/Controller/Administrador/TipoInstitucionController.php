<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\TipoInstitucion;
use AppBundle\Form\Type\TipoInstitucionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class TipoInstitucionController extends Controller {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/tipos_de_institucion/", name="tipo_instituciones")
     */
    public function tiposInstitucionAction(Request $request) {
        $tipoInstituciones = $this->getDoctrine()->getRepository('AppBundle:TipoInstitucion')->findAll();
        return $this->render(
                        'admin/tipo_instituciones/list.html.twig', array('tipo_instituciones' => $tipoInstituciones)
        );
    }

    /**
     * @Route("/admin/institucion/", name="nuevo tipo de institucion")
     */
    public function nuevoTipoInstitucionAction(Request $request) {
        $tipoInstitucion = new TipoInstitucion();
        $form = $this->createForm(TipoInstitucionType::class, $tipoInstitucion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($tipoInstitucion);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_instituciones');
        }

        return $this->render('admin/tipo_instituciones/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/institucion/{id}", name="editar tipo de institucion")
     */
    public function editarTipoInstitucionAction($id, Request $request) {
        $tipoInstitucion = $this->_getObject('AppBundle:TipoInstitucion', $id);
        $form = $this->createForm(TipoInstitucionType::class, $tipoInstitucion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('tipo_instituciones');
        }
        return $this->render('admin/tipo_instituciones/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_tipo_institucion/{id}", name="ver tipo de institucion")
     */
    public function verTipoInstitucionAction($id, Request $request) {
        $tipoInstitucion = $this->_getObject('AppBundle:TipoInstitucion', $id);
        return $this->render(
                        'admin/tipo_instituciones/form.html.twig', array(
                    'op' => "vista",
                    'tipo_institucion' => $tipoInstitucion
                        )
        );
    }

}
