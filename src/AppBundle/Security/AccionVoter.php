<?php

namespace AppBundle\Security;

use AppBundle\Entity\Accion;
use AppBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AccionVoter extends Voter {

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

        // only vote on Accion objects inside this voter
        if (!$subject instanceof Accion) {
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
        /** @var Accion $accion */
        $accion = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($accion, $user);
            case self::EDIT:
                return $this->canEdit($accion, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    private function canView(Accion $accion, User $user) {
        // if they can edit, they can view
        if ($this->canEdit($accion, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return (($user === $accion->getMiembro()) || ($user === $accion->getMiembro()->getDirector()) || ($user === $accion->getMiembro()->getDirector()->getSostenedor()));
    }

    private function canEdit(Accion $accion, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return (($user === $accion->getMiembro()) || ($user === $accion->getMiembro()->getDirector()));
    }

}
