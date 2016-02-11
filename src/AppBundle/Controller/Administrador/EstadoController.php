<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\Estado;
use AppBundle\Form\Type\EstadoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class EstadoController extends Controller {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/rubricas/", name="rubricas")
     */
    public function rubricasAction(Request $request) {
        $estados = $this->getDoctrine()->getRepository('AppBundle:Estado')->findAll();
        return $this->render(
                        'admin/estados/list.html.twig', array('estados' => $estados)
        );
    }

    /**
     * @Route("/admin/rubrica/", name="nueva rubrica")
     */
    public function nuevaRubricaAction(Request $request) {
        $estado = new Estado();
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($estado);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }

        return $this->render('admin/estados/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/rubrica/{id}", name="editar rubrica")
     */
    public function editarRubricaAction($id, Request $request) {
        $estado = $this->_getObject('AppBundle:Estado', $id);
        $form = $this->createForm(EstadoType::class, $estado);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('rubricas');
        }
        return $this->render('admin/estados/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_rubrica/{id}", name="ver rubrica")
     */
    public function verRubricaAction($id, Request $request) {
        $estado = $this->_getObject('AppBundle:Estado', $id);
        return $this->render(
                        'admin/estados/form.html.twig', array(
                    'op' => "vista",
                    'estado' => $estado
                        )
        );
    }

}