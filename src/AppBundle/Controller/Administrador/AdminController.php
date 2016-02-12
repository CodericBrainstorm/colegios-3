<?php

// src/AppBundle/Controller/AdminController.php

namespace AppBundle\Controller\Administrador;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AdminController extends Controller {

    /**
     * @Route("/admin/")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'admin/index.html.twig', array('params' => 1)
        );
    }

}
