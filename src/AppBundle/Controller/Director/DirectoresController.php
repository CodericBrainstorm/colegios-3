<?php

namespace AppBundle\Controller\Director;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_DIRECTOR')") 
 */
class DirectoresController extends Controller {

    /**
     * @Route("/director/", name="director_index")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'director/index.html.twig'
        );
    }

}
