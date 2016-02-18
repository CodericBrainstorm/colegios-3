<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"administrador" = "Administrador", "sostenedor" = "Sostenedor", "director" = "Director", "miembro" = "Miembro"})
 */
abstract class User extends BaseUser {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**     
     * @var string
     * 
     * @Assert\NotBlank(message = "user.nombre.not_blank")
     * @ORM\Column(name="nombre", type="string", length=255) 
     */ 
    protected $nombre;
    /**     
     * @var string
     * 
     * @Assert\NotBlank(message = "user.apellido.not_blank")
     * @ORM\Column(name="apellido", type="string", length=255) 
     */ 
    protected $apellido;

//    public function __construct() {
//        parent::__construct();
        // your own logic
//    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return User
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }
    
    public function getType(){
        return \AppBundle\Form\Type\UserType::class;
    }
}
