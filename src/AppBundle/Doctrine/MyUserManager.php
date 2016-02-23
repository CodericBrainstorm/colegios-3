<?php

namespace AppBundle\Doctrine;

use PUGX\MultiUserBundle\Doctrine\UserManager;

class MyUserManager extends UserManager {

    /**
     * {@inheritDoc}
     */
    public function findUsersByClass($class_to_get) {
        $classes = $this->userDiscriminator->getClasses();

        $usersAll = array();
        foreach ($classes as $class) {
            if ($class_to_get === $class) {
                $repo = $this->om->getRepository($class);

                $users = $repo->findAll();

                if ($users) {
                    $usersAll = array_merge($usersAll, $users); // $usersAll
                }
            }
        }

        return $usersAll;
    }

}
