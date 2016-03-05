<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigRepository")
 * 
 */
class Config {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(message = "ano.nombre.not_blank")
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $titulo;
    
    /**
     * @ORM\OneToOne(targetEntity="Estado")
     */
    private $estadoPredefinido;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Config
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set estado predefinido
     *
     * @param Estado $estado
     * @return Config
     */
    public function setEstadoPredefinido($estado) {
        $this->estadoPredefinido = $estado;

        return $this;
    }

    /**
     * Get estado predefinido
     *
     * @return Estado 
     */
    public function getEstadoPredefinido() {
        return $this->estadoPredefinido;
    }

}
