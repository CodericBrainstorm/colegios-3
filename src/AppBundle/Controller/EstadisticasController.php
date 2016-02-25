<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Controlador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;

/**
 * @Security("has_role('ROLE_USER')") 
 */
class EstadisticasController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait,
        \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/{role}/estadisticas/", name="estadisticas")
     */
    public function cambiarAnoAction(Request $request) {
        $user = $this->getUser();
        $areas = $this->getDoctrine()->getRepository('AppBundle:Area')->findBy(array('ano' => $user->getAno()));
        $stats = $user->getCompromisos();
        return $this->render('sostenedor/estadisticas/show.html.twig', array('areas' => $areas, 'compromisos' => $stats));
    }

}
