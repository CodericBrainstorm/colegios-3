<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\CompromisoReal;
use AppBundle\Form\Type\CompromisoRealType;
use AppBundle\Form\Type\CompromisoRealViewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class CompromisoRealController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;
    
    /**
     * @Route("/{role}/compromisos_asignados/", name="ver compromisos asignados")
     */
    public function verCompromisosAsignadosAction(Request $request) {
        $sostenedor = $this->getUser();
        $compromisos = $this->getDoctrine()->getRepository('AppBundle:CompromisoReal')->findBySostenedor($sostenedor);
        
        return $this->render(
                        'sostenedor/compromisosReales/list.html.twig', array('compromisos' => $compromisos, 'sostenedor' => $sostenedor)
        );
    }

    /**
     * @Route("/{role}/asignar_compromiso/", name="asignar compromiso")
     */
    public function asignarCompromisoAction($role, Request $request) {
        $sostenedor = $this->getUser();
        $compromiso = new CompromisoReal();
        $form = $this->createForm(CompromisoRealType::class, $compromiso, array('sostenedor'=>$sostenedor));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($compromiso);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('ver compromisos asignados', array('role'=>$role, 'id'=>$sostenedor->getId()));
        }
        return $this->render($this->form_template, array('title' => "compromisoReal.views.new.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/compromiso_asignado/{id}", name="editar compromiso asignado")
     */
    public function editarCompromisoAsignadoAction($role, $id, Request $request) {
        $sostenedor = $this->getUser();
        $compromiso = $this->_getObject('AppBundle:CompromisoReal', $id);
        $this->denyAccessUnlessGranted('edit', $compromiso);
        $form = $this->createForm(CompromisoRealType::class, $compromiso, array('sostenedor'=>$sostenedor));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('compromisos_asignados', array('role'=>$role, 'id'=>$sostenedor->getId()));
        }
        return $this->render($this->form_template, array('title' => "compromisoReal.views.edit.title", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{role}/ver_compromiso_asignado/{id}", name="ver compromiso asignado")
     */
    public function verCompromisoAsignadoAction($id, Request $request) {
        $sostenedor = $this->getUser();
        $compromiso = $this->_getObject('AppBundle:CompromisoReal', $id);
        $this->denyAccessUnlessGranted('view', $compromiso);
        $form = $this->createForm(CompromisoRealType::class, $compromiso, array('sostenedor'=>$sostenedor, 'file_path'=>'getWebPath', 'disabled' => true));
        $form->handleRequest($request);
        return $this->render(
                $this->form_template, array(
                'title' => "compromisoReal.views.ver.title",
                'form' => $form->createView()
                )
        );
    }

}