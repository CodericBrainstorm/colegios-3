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
     * @Route("/{role}/estadisticas/{id}", defaults={"id" = "own"}, name="estadisticas")
     */
    public function cambiarAnoAction($id, Request $request) {
        if ($id === "own") {
            $user = $this->getUser();
            $this->denyAccessUnlessGranted('edit', $user);
        } else {
            $user = $this->_obtenerUser('AppBundle\Entity\Director', $id, 'edit');
        }
        $areas = $this->_getObjectsBy('AppBundle:Area', array('ano' => $user->getAno()));
        return $this->render('sostenedor/estadisticas/show.html.twig', array('user' => $user, 'areas' => $areas, 'director' => $user));
    }

}
