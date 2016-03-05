<?php

namespace AppBundle\Controller\Director;

use AppBundle\Controller\Controlador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class DirectoresController extends Controlador {

    /**
     * @Route("/director/", name="director_index")
     */
    public function indexAction(Request $request) {
        return $this->redirectToRoute('estadisticas', array('role' => 'director'));
    }

}
