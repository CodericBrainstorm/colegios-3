<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/register/administrador", name="administrador_registration")
     */
    public function crearadminAction(Request $request) {

        return $this->container
                        ->get('pugx_multi_user.registration_manager')
                        ->register('AppBundle\Entity\Administrador');
    }

    /**
     * @Route("/crearcosas", name="crearcosas")
     */
    public function comunaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $ciudad = new \AppBundle\Entity\Ciudad();
        $ciudad->setNombre("Ciudad 1");
        $em->persist($ciudad);

        $comuna = new \AppBundle\Entity\Comuna();
        $comuna->setNombre("Comuna 1");
        $comuna->setCiudad($ciudad);
        $em->persist($comuna);

        $tipoInstitucion = new \AppBundle\Entity\TipoInstitucion();
        $tipoInstitucion->setNombre("Tipo 1");
        $em->persist($tipoInstitucion);

        $em->flush();
        return $this->render('default/index.html.twig', array('user' => 'hola', 'users' => 'holas',
                    'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
        ));
    }

}
