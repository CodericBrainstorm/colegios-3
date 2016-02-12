<?php

namespace AppBundle\Controller\Utils;

trait DBUsersUtilsTrait {

    private $form_template = 'base_form.html.twig';
    private $view_template = 'base_view.html.twig';
    
    private function _obtenerUserManager($class) {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass($class);
        return $this->container->get('pugx_user_manager');
    }

}
