<?php
namespace AppBundle\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $authorizationChecker;

    public function __construct(Router $router, AuthorizationChecker $authorizationChecker) {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        $response = null;

        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('admin_index'));
        } else if ($this->authorizationChecker->isGranted('ROLE_SOSTENEDOR')) {
            $response = new RedirectResponse($this->router->generate('sostenedor_index'));
        } else if ($this->authorizationChecker->isGranted('ROLE_DIRECTOR')) {
            $response = new RedirectResponse($this->router->generate('director_index'));
        } else if ($this->authorizationChecker->isGranted('ROLE_MIEMBRO')) {
            $response = new RedirectResponse($this->router->generate('miembro_index'));
        }

        return $response;
    }

}