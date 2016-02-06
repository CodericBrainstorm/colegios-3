<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Accion
 *
 * @ORM\Table(name="accion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccionRepository")
 */
class Accion {

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
     * @Assert\NotBlank(message = "accion.nombre.not_blank")
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Assert\NotNull(message = "accion.descripcion.not_null")
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @Assert\Date(message = "assert.date")
     * @ORM\Column(name="fechaInicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @Assert\Date(message = "assert.date")
     * @ORM\Column(name="fechaFin", type="date")
     */
    private $fechaFin;

    /**
     * @var bool
     *
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\Column(name="verificado", type="boolean")
     */
    private $verificado;

    /**
     * @ORM\ManyToOne(targetEntity="Miembro", inversedBy="acciones")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $miembro;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $estadoDirector;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $estadoMiembro;

    /**
     * @ORM\ManyToOne(targetEntity="Hito", inversedBy="acciones")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $hito;

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
     * @return Accion
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Accion
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Accion
     */
    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Accion
     */
    public function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin() {
        return $this->fechaFin;
    }

    /**
     * Set verificado
     *
     * @param boolean $verificado
     * @return Accion
     */
    public function setVerificado($verificado) {
        $this->verificado = $verificado;

        return $this;
    }

    /**
     * Get verificado
     *
     * @return boolean 
     */
    public function getVerificado() {
        return $this->verificado;
    }

    /**
     * Set miembro
     *
     * @param \AppBundle\Entity\Miembro $miembro
     * @return Accion
     */
    public function setMiembro(\AppBundle\Entity\Miembro $miembro = null) {
        $this->miembro = $miembro;

        return $this;
    }

    /**
     * Get miembro
     *
     * @return \AppBundle\Entity\Miembro 
     */
    public function getMiembro() {
        return $this->miembro;
    }

    /**
     * Set estadoDirector
     *
     * @param \AppBundle\Entity\Estado $estadoDirector
     * @return Accion
     */
    public function setEstadoDirector(\AppBundle\Entity\Estado $estadoDirector = null) {
        $this->estadoDirector = $estadoDirector;

        return $this;
    }

    /**
     * Get estadoDirector
     *
     * @return \AppBundle\Entity\Estado 
     */
    public function getEstadoDirector() {
        return $this->estadoDirector;
    }

    /**
     * Set estadoMiembro
     *
     * @param \AppBundle\Entity\Estado $estadoMiembro
     * @return Accion
     */
    public function setEstadoMiembro(\AppBundle\Entity\Estado $estadoMiembro = null) {
        $this->estadoMiembro = $estadoMiembro;

        return $this;
    }

    /**
     * Get estadoMiembro
     *
     * @return \AppBundle\Entity\Estado 
     */
    public function getEstadoMiembro() {
        return $this->estadoMiembro;
    }

    /**
     * Set hito
     *
     * @param \AppBundle\Entity\Hito $hito
     * @return Accion
     */
    public function setHito(\AppBundle\Entity\Hito $hito = null) {
        $this->hito = $hito;

        return $this;
    }

    /**
     * Get hito
     *
     * @return \AppBundle\Entity\Hito 
     */
    public function getHito() {
        return $this->hito;
    }

}
