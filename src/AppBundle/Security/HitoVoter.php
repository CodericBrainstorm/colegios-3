<?php

namespace AppBundle\Security;

use AppBundle\Entity\Hito;
use AppBundle\Entity\User;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HitoVoter extends Voter {

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

        // only vote on Hito objects inside this voter
        if (!$subject instanceof Hito) {
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
        /** @var Hito $hito */
        $hito = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($hito, $user);
            case self::EDIT:
                return $this->canEdit($hito, $user);
        }

        throw new LogicException('This code should not be reached!');
    }

    private function canView(Hito $hito, User $user) {
        // if they can edit, they can view
        if ($this->canEdit($hito, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return (in_array($user, $hito->getMiembros()));
    }

    private function canEdit(Hito $hito, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return (($user === $hito->getCompromiso()->getCompromiso()->getSostenedor()) || ($user === $hito->getCompromiso()->getDirector()));
    }

}
