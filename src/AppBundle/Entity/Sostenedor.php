<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Area;

/**
 * Sostenedor
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SostenedorRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields = "username", targetClass = "AppBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "AppBundle\Entity\User", message="fos_user.email.already_used")
 */
class Sostenedor extends User {

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
     * @Assert\NotBlank(message = "sostenedor.nombreInstitucion.not_blank")
     * @ORM\Column(type="string", length=255) 
     */
    private $nombreInstitucion;

    /**
     * @var string
     * 
     * @Assert\NotBlank(message = "sostenedor.direccion.not_blank")
     * @ORM\Column(type="string", length=255) 
     */
    private $direccion;

    /**
     * @ORM\OneToMany(targetEntity="Director", mappedBy="sostenedor")
     */
    private $directores;

    /**
     * @ORM\ManyToOne(targetEntity="TipoInstitucion")
     */
    private $tipoInstitucion;

    /**
     * @ORM\ManyToOne(targetEntity="Ciudad")
     */
    private $ciudad;

    /**
     * @ORM\ManyToOne(targetEntity="Comuna")
     */
    private $comuna;

    /**
     * @ORM\OneToMany(targetEntity="Compromiso", mappedBy="sostenedor")
     */
    private $compromisos;

    /**
     * Constructor
     */
    public function __construct() {
        $this->directores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->compromisos = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->addRole("ROLE_SOSTENEDOR");
    }

    /**
     * Add directores
     *
     * @param \AppBundle\Entity\Director $directores
     * @return Sostenedor
     */
    public function addDirectore(\AppBundle\Entity\Director $directores) {
        $this->directores[] = $directores;

        return $this;
    }

    /**
     * Remove directores
     *
     * @param \AppBundle\Entity\Director $directores
     */
    public function removeDirectore(\AppBundle\Entity\Director $directores) {
        $this->directores->removeElement($directores);
    }

    /**
     * Get directores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDirectores() {
        return $this->directores;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Sostenedor
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
     * Set apellido
     *
     * @param string $apellido
     * @return Sostenedor
     */
    public function setApellido($apellido) {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido() {
        return $this->apellido;
    }

    /**
     * Set tipoInstitucion
     *
     * @param \AppBundle\Entity\TipoInstitucion $tipoInstitucion
     * @return Sostenedor
     */
    public function setTipoInstitucion(\AppBundle\Entity\TipoInstitucion $tipoInstitucion = null) {
        $this->tipoInstitucion = $tipoInstitucion;

        return $this;
    }

    /**
     * Get tipoInstitucion
     *
     * @return \AppBundle\Entity\TipoInstitucion 
     */
    public function getTipoInstitucion() {
        return $this->tipoInstitucion;
    }

    /**
     * Set nombreInstitucion
     *
     * @param string $nombreInstitucion
     * @return Sostenedor
     */
    public function setNombreInstitucion($nombreInstitucion) {
        $this->nombreInstitucion = $nombreInstitucion;

        return $this;
    }

    /**
     * Get nombreInstitucion
     *
     * @return string 
     */
    public function getNombreInstitucion() {
        return $this->nombreInstitucion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Sostenedor
     */
    public function setDireccion($direccion) {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set comuna
     *
     * @param \AppBundle\Entity\Comuna $comuna
     * @return Sostenedor
     */
    public function setComuna(\AppBundle\Entity\Comuna $comuna = null) {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return \AppBundle\Entity\Comuna 
     */
    public function getComuna() {
        return $this->comuna;
    }

    /**
     * Add compromisos
     *
     * @param \AppBundle\Entity\Compromiso $compromisos
     * @return Sostenedor
     */
    public function addCompromiso(\AppBundle\Entity\Compromiso $compromisos) {
        $this->compromisos[] = $compromisos;

        return $this;
    }

    /**
     * Remove compromisos
     *
     * @param \AppBundle\Entity\Compromiso $compromisos
     */
    public function removeCompromiso(\AppBundle\Entity\Compromiso $compromisos) {
        $this->compromisos->removeElement($compromisos);
    }

    /**
     * Get compromisos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompromisos() {
        return $this->compromisos;
    }

    /**
     * Set ciudad
     *
     * @param \AppBundle\Entity\Ciudad $ciudad
     * @return Sostenedor
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

    public function getType() {
        return \AppBundle\Form\Type\SostenedorType::class;
    }

    /**
     * Get PorcentajeDelArea
     *
     * @return float 
     */
    public function getPorcentajeDelArea(Area $area) {
        $porcentaje = 0;
        foreach ($this->compromisos as $compromiso) {
            if ($compromiso->getArea() === $area) {
                $porcentaje += $compromiso->getPonderacion();
            }
        }
        return $porcentaje;
    }

}
