<?php

namespace AppBundle\Listener;

use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Twig_Environment;

class RoleVarListener {

    protected $twig;
    protected $authorizationChecker;

    public function __construct(Twig_Environment $twig, AuthorizationChecker $authorizationChecker) {
        $this->twig = $twig;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onKernelRequest() {
        $role = 'anonimo';
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $role = 'admin';
        } else if ($this->authorizationChecker->isGranted('ROLE_SOSTENEDOR')) {
            $role = 'sostenedor';
        } else if ($this->authorizationChecker->isGranted('ROLE_DIRECTOR')) {
            $role = 'director';
        } else if ($this->authorizationChecker->isGranted('ROLE_MIEMBRO')) {
            $role = 'miembro';
        }
        $this->twig->addGlobal('role', $role);
    }

}
