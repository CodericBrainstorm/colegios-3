<?php

namespace AppBundle\Entity;

use AppBundle\Form\Type\AdministradorType;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

/**
 * Administrador
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdministradorRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\User", message="fos_user.email.already_used")
 */
class Administrador extends User {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->addRole("ROLE_SUPER_ADMIN");
    }

    public function getType() {
        return AdministradorType::class;
    }

}
