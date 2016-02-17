<?php

namespace AppBundle\Controller\Miembro;

use AppBundle\Controller\Controlador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_MIEMBRO')") 
 */
class MiembrosController extends Controlador {

    /**
     * @Route("/miembro/", name="miembro_index")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'miembro/index.html.twig'
        );
    }

}
