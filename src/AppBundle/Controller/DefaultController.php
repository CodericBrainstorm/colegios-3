<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;


class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('fos_user_security_login');
        } else {
            if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('admin_index');
            } else if ($this->get('security.authorization_checker')->isGranted('ROLE_SOSTENEDOR')) {
                return $this->redirectToRoute('sostenedor_index');
            } else if ($this->get('security.authorization_checker')->isGranted('ROLE_DIRECTOR')) {
                return $this->redirectToRoute('director_index');
            } else if ($this->get('security.authorization_checker')->isGranted('ROLE_MIEMBRO')) {
                return $this->redirectToRoute('miembro_index');
            } else {
                return $this->redirectToRoute('fos_user_security_login');
            }
        }
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
