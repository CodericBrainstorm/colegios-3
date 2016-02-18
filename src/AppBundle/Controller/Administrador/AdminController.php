<?php

namespace AppBundle\Controller\Administrador;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\AdministradorType;
use AppBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;

/**
 * @Security("has_role('ROLE_ADMIN')") 
 */
class AdminController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait;

    /**
     * @Route("/admin/", name="admin_index")
     */
    public function indexAction(Request $request) {
        return $this->render(
                        'admin/index.html.twig', array('params' => 1)
        );
    }

}
