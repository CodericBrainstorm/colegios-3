<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CompromisoReal
 *
 * @ORM\Table(name="compromiso_real")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompromisoRealRepository")
 */
class CompromisoReal {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\Column(name="verificado", type="boolean")
     */
    private $verificado;

    /**
     * @ORM\ManyToOne(targetEntity="Compromiso", inversedBy="compromisosReales")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $compromiso;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $estadoDirector;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $estadoSostenedor;

    /**
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="compromisos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $director;

    /**
     * @ORM\OneToMany(targetEntity="Hito", mappedBy="compromiso")
     */
    private $hitos;

    /**
     * @ORM\OneToOne(targetEntity="Archivo")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $medioVerificacion;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set verificado
     *
     * @param boolean $verificado
     * @return CompromisoReal
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
     * Set compromiso
     *
     * @param \AppBundle\Entity\Compromiso $compromiso
     * @return CompromisoReal
     */
    public function setCompromiso(\AppBundle\Entity\Compromiso $compromiso = null) {
        $this->compromiso = $compromiso;

        return $this;
    }

    /**
     * Get compromiso
     *
     * @return \AppBundle\Entity\Compromiso 
     */
    public function getCompromiso() {
        return $this->compromiso;
    }

    /**
     * Set estadoDirector
     *
     * @param \AppBundle\Entity\Estado $estadoDirector
     * @return CompromisoReal
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
     * @return CompromisoReal
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
     * Set director
     *
     * @param \AppBundle\Entity\Director $director
     * @return CompromisoReal
     */
    public function setDirector(\AppBundle\Entity\Director $director = null) {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \AppBundle\Entity\Director 
     */
    public function getDirector() {
        return $this->director;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->hitos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hitos
     *
     * @param \AppBundle\Entity\Hito $hitos
     * @return CompromisoReal
     */
    public function addHito(\AppBundle\Entity\Hito $hitos) {
        $this->hitos[] = $hitos;

        return $this;
    }

    /**
     * Remove hitos
     *
     * @param \AppBundle\Entity\Hito $hitos
     */
    public function removeHito(\AppBundle\Entity\Hito $hitos) {
        $this->hitos->removeElement($hitos);
    }

    /**
     * Get hitos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHitos() {
        return $this->hitos;
    }


    /**
     * Set medioVerificacion
     *
     * @param \AppBundle\Entity\Archivo $medioVerificacion
     * @return CompromisoReal
     */
    public function setMedioVerificacion(\AppBundle\Entity\Archivo $medioVerificacion = null)
    {
        $this->medioVerificacion = $medioVerificacion;

        return $this;
    }

    /**
     * Get medioVerificacion
     *
     * @return \AppBundle\Entity\Archivo 
     */
    public function getMedioVerificacion()
    {
        return $this->medioVerificacion;
    }
}
