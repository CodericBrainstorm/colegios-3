<?php

namespace AppBundle\Security;

use AppBundle\Entity\Miembro;
use AppBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MiembroVoter extends Voter {

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

        if (!$subject instanceof Miembro) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN'))) {
            return true;
        }
        /** @var Miembro $miembro */
        $miembro = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($miembro, $user);
            case self::EDIT:
                return $this->canEdit($miembro, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    private function canView(Miembro $miembro, User $user) {
        if ($this->canEdit($miembro, $user)) {
            return true;
        } else {
            return false;
        }
    }

    private function canEdit(Miembro $miembro, User $user) {
        $director = $miembro->getDirector();
        return ($user === $miembro || $user === $director || $user === $director->getSostenedor());
    }

}
