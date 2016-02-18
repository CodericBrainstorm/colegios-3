<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class SostenedoresController extends Controlador {

    /**
     * @Route("/sostenedor/", name="sostenedor_index")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'sostenedor/index.html.twig'
        );
    }

}