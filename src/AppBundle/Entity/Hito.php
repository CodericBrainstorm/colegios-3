<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Hito
 *
 * @ORM\Table(name="hito")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HitoRepository")
 */
class Hito {

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
     * @Assert\NotBlank(message = "hito.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Assert\NotNull(message = "hito.descripcion.not_null")
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @var float
     *
     * @Assert\Type(type="float", message="hito.ponderacion.type")
     * @ORM\Column(type="float")
     */
    private $ponderacion;

    /**
     * @var \DateTime
     *
     * @Assert\Date(message = "assert.date")
     * @ORM\Column(type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @Assert\Date(message = "assert.date")
     * @ORM\Column(type="date")
     */
    private $fechaFin;

    /**
     * @var bool
     *
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\Column(type="boolean")
     */
    private $verificado;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="Ano")
     * @ORM\JoinColumn(name="ano_id", referencedColumnName="id", nullable=false)
     */
    private $ano;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="estado_director_id", referencedColumnName="id", nullable=false)
     */
    private $estadoDirector;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="estado_sostenedor_id", referencedColumnName="id", nullable=false)
     */
    private $estadoSostenedor;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="CompromisoReal", inversedBy="hitos")
     * @ORM\JoinColumn(name="compromiso_id", referencedColumnName="id", nullable=false)
     */
    private $compromiso;

    /**
     * @ORM\ManyToMany(targetEntity="Miembro", inversedBy="hitos")
     */
    private $miembros;

    /**
     * @ORM\OneToMany(targetEntity="Accion", mappedBy="hito", cascade={"remove"})
     */
    private $acciones;

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
     * @return Hito
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
     * @return Hito
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
     * Set ponderacion
     *
     * @param float $ponderacion
     * @return Hito
     */
    public function setPonderacion($ponderacion) {
        $this->ponderacion = $ponderacion;

        return $this;
    }

    /**
     * Get ponderacion
     *
     * @return float 
     */
    public function getPonderacion() {
        return $this->ponderacion;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Hito
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
     * @return Hito
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
     * @return Hito
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
     * Constructor
     */
    public function __construct() {
        $this->miembros = new \Doctrine\Common\Collections\ArrayCollection();
        $this->acciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set estadoDirector
     *
     * @param \AppBundle\Entity\Estado $estadoDirector
     * @return Hito
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
     * Set estadoSostenedor
     *
     * @param \AppBundle\Entity\Estado $estadoSostenedor
     * @return Hito
     */
    public function setEstadoSostenedor(\AppBundle\Entity\Estado $estadoSostenedor = null) {
        $this->estadoSostenedor = $estadoSostenedor;

        return $this;
    }

    /**
     * Get estadoSostenedor
     *
     * @return \AppBundle\Entity\Estado 
     */
    public function getEstadoSostenedor() {
        return $this->estadoSostenedor;
    }

    /**
     * Set compromiso
     *
     * @param \AppBundle\Entity\CompromisoReal $compromiso
     * @return Hito
     */
    public function setCompromiso(\AppBundle\Entity\CompromisoReal $compromiso = null) {
        $this->compromiso = $compromiso;

        return $this;
    }

    /**
     * Get compromiso
     *
     * @return \AppBundle\Entity\CompromisoReal 
     */
    public function getCompromiso() {
        return $this->compromiso;
    }

    /**
     * Add miembros
     *
     * @param \AppBundle\Entity\Miembro $miembros
     * @return Hito
     */
    public function addMiembro(\AppBundle\Entity\Miembro $miembros) {

        $miembros->addHito($this);
        $this->miembros[] = $miembros;

        return $this;
    }

    /**
     * Remove miembros
     *
     * @param \AppBundle\Entity\Miembro $miembros
     */
    public function removeMiembro(\AppBundle\Entity\Miembro $miembros) {
        $miembros->getHitos()->removeElement($this);
        $this->miembros->removeElement($miembros);
    }

    /**
     * Get miembros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMiembros() {
        return $this->miembros;
    }

    /**
     * Add acciones
     *
     * @param \AppBundle\Entity\Accion $acciones
     * @return Hito
     */
    public function addAccione(\AppBundle\Entity\Accion $acciones) {
        $this->acciones[] = $acciones;

        return $this;
    }

    /**
     * Remove acciones
     *
     * @param \AppBundle\Entity\Accion $acciones
     */
    public function removeAccione(\AppBundle\Entity\Accion $acciones) {
        $this->acciones->removeElement($acciones);
    }

    /**
     * Get acciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAcciones() {
        return $this->acciones;
    }

    /**
     * Set ano
     *
     * @param \AppBundle\Entity\Ano $ano
     * @return Hito
     */
    public function setAno(\AppBundle\Entity\Ano $ano = null) {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return \AppBundle\Entity\Ano 
     */
    public function getAno() {
        return $this->ano;
    }

}
