<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comuna
 *
 * @ORM\Table(name="comuna")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComunaRepository")
 */
class Comuna {

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
     * @Assert\NotBlank(message = "comuna.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="Ciudad", inversedBy="comunas")
     * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id", nullable=false)
     */
    private $ciudad;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean")
     */
    private $borrado;

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
     * @return Comuna
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set ciudad
     *
     * @param \AppBundle\Entity\Ciudad $ciudad
     * @return Comuna
     */
    public function setCiudad(\AppBundle\Entity\Ciudad $ciudad = null) {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \AppBundle\Entity\Ciudad 
     */
    public function getCiudad() {
        return $this->ciudad;
    }
    
    /**
     * Set borrado
     *
     * @param boolean $borrado
     * @return Comuna
     */
    public function setBorrado($borrado) {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean 
     */
    public function getBorrado() {
        return $this->borrado;
    }

    /**
     * borrar
     *
     * @return Comuna
     */
    public function borrar() {
        $this->setBorrado(true);
    }
}
