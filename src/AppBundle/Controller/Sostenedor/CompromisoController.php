<?php

namespace AppBundle\Controller\Sostenedor;

use AppBundle\Controller\Controlador;
use AppBundle\Entity\Compromiso;
use AppBundle\Form\Type\CompromisoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_SOSTENEDOR')") 
 */
class CompromisoController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait, \AppBundle\Controller\Utils\DBGeneralUtilsTrait;
    
    /**
     * @Route("/sostenedor/compromisos_sostenedor/{id}", name="ver compromisos sostenedor")
     */
    public function verCompromisosSostenedorAction($id, Request $request) {
        $sostenedor = $this->_obtenerUser('AppBundle\Entity\Sostenedor', $id, 'view');
        return $this->_listarObjects('AppBundle:Compromiso', 'compromisos', 'sostenedor/compromisos/list.html.twig', array('ano' => $this->getUser()->getAno()->getId(), 'sostenedor'=>$sostenedor));
    }
    
    /**
     * @Route("/sostenedor/ver_compromiso/{id}", name="ver compromiso sostenedor")
     */
    public function verCompromisoAction($id, Request $request) {
        return $this->_verObject($request, $id, 'AppBundle:Compromiso', CompromisoType::class, 'compromiso', array('disabled'=>true));
    }

}
