<?php

namespace AppBundle\Controller;

use AppBundle\Controller\Controlador;
use AppBundle\Form\Type\AnoSelectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as Security;

/**
 * @Security("has_role('ROLE_USER')") 
 */
class AnoController extends Controlador {

    use \AppBundle\Controller\Utils\DBUsersUtilsTrait,
        \AppBundle\Controller\Utils\DBGeneralUtilsTrait;

    /**
     * @Route("/{role}/selecccionar/{id_ano}", name="cambiar_ano")
     */
    public function cambiarAnoAction($role, $id_ano, Request $request) {
        $ano = $this->_getObject('AppBundle:Ano', $id_ano);
        $user = $this->getUser();
        $user->setAno($ano);
        $userManager = $this->_obtenerUserManager(get_class($user));
        $userManager->updateUser($user, true);
        $session = $this->get("session");
        $usan_ano = array('area', 'compromiso', 'hito', 'accion', 'compromiso_real');
        if ($this->contains($session->get("redirect_route"), $usan_ano) && isset($session->get("redirect_params")['id'])) {
            return $this->redirectToRoute($role . '_index');
        } else {
            return $this->redirectToRoute($session->get("redirect_route"), $session->get("redirect_params"));
        }
    }

    /**
     * @Route("/{role}/ano/select", name="select ano")
     */
    public function selectAction($redirect, Request $request) {
        $user = $this->getUser();
        $session = $this->get("session");
        $session->set("redirect_route", $redirect->get('_route'));
        $session->set("redirect_params", $redirect->get('_route_params'));
        $form = $this->createForm(AnoSelectType::class, $user);
        return $this->render(
                        'utils/anos.html.twig', array('form_anos' => $form->createView())
        );
    }

    private function contains($str, array $arr) {
        foreach ($arr as $a) {
            if (stripos($str, $a) !== false)
                return true;
        }
        return false;
    }

}
