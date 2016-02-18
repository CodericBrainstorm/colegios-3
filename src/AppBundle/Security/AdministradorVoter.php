<?php

namespace AppBundle\Security;

use AppBundle\Entity\Administrador;
use AppBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AdministradorVoter extends Voter {

    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager) {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject) {
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        if (!$subject instanceof Administrador) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }
        /** @var Administrador $administrador */
        $administrador = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($administrador, $user);
            case self::EDIT:
                return $this->canEdit($administrador, $user);
        }
        throw new LogicException('This code should not be reached!');
    }

    private function canView(Administrador $administrador, User $user) {
        if ($this->canEdit($administrador, $user)) {
            return true;
        }
    }

    private function canEdit(Administrador $administrador, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return ($user === $administrador);
    }

}
