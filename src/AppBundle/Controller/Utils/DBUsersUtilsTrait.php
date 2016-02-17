<?php

namespace AppBundle\Controller\Utils;

trait DBUsersUtilsTrait {
    
    private function _obtenerUserManager($class) {
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator');
        $discriminator->setClass($class);
        return $this->container->get('pugx_user_manager');
    }

}
