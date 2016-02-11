<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use AppBundle\Entity\Comuna;
use AppBundle\Form\Type\ComunaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class ComunaController extends Controller {

    use \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/admin/comunas/", name="comunas")
     */
    public function comunasAction(Request $request) {
        $comunas = $this->getDoctrine()->getRepository('AppBundle:Comuna')->findAll();
        return $this->render(
                        'admin/comunas/list.html.twig', array('comunas' => $comunas)
        );
    }

    /**
     * @Route("/admin/comuna/", name="nueva comuna")
     */
    public function nuevaComunaAction(Request $request) {
        $comuna = new Comuna();
        $form = $this->createForm(ComunaType::class, $comuna);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_persistObject($comuna);
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('comunas');
        }

        return $this->render('admin/comunas/form.html.twig', array('op' => "alta", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/comuna/{id}", name="editar comuna")
     */
    public function editarComunaAction($id, Request $request) {
        $comuna = $this->_getObject('AppBundle:Comuna', $id);
        $form = $this->createForm(ComunaType::class, $comuna);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->_updateObject();
            $this->addFlash('success', 'flash.success.cambio');
            return $this->redirectToRoute('comunas');
        }
        return $this->render('admin/comunas/form.html.twig', array('op' => "modificacion", 'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/ver_comuna/{id}", name="ver comuna")
     */
    public function verComunaAction($id, Request $request) {
        $comuna = $this->_getObject('AppBundle:Comuna', $id);
        return $this->render(
                        'admin/comuna/form.html.twig', array(
                    'op' => "vista",
                    'comuna' => $comuna
                        )
        );
    }

}
