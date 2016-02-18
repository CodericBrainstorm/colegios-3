<?php

namespace AppBundle\Security;

use AppBundle\Entity\Sostenedor;
use AppBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SostenedorVoter extends Voter {

    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager) {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject) {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Sostenedor objects inside this voter
        if (!$subject instanceof Sostenedor) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN'))) {
            return true;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var Sostenedor $sostenedor */
        $sostenedor = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($sostenedor, $user);
            case self::EDIT:
                return $this->canEdit($sostenedor, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    private function canView(Sostenedor $sostenedor, User $user) {
        // if they can edit, they can view
        if ($this->canEdit($sostenedor, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        $director = $sostenedor->getDirector();
        if ($director === $user) {
            return true;
        } else {
            if (is_array($director->getMiembros())) {
                return in_array($user, $director->getMiembros());
            } else {
                return false;
            }
        }
    }

    private function canEdit(Sostenedor $sostenedor, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return ($user === $sostenedor);
    }

}
