<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="area")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AreaRepository")
 */
class Area {

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
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $ponderacion;

    /**
     * @ORM\OneToMany(targetEntity="Compromiso", mappedBy="area")
     */
    private $compromisos;

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
     * @return Area
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
     * @return Area
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
     * @return Area
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
     * Constructor
     */
    public function __construct()
    {
        $this->compromisos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add compromisos
     *
     * @param \AppBundle\Entity\Compromiso $compromisos
     * @return Area
     */
    public function addCompromiso(\AppBundle\Entity\Compromiso $compromisos)
    {
        $this->compromisos[] = $compromisos;

        return $this;
    }

    /**
     * Remove compromisos
     *
     * @param \AppBundle\Entity\Compromiso $compromisos
     */
    public function removeCompromiso(\AppBundle\Entity\Compromiso $compromisos)
    {
        $this->compromisos->removeElement($compromisos);
    }

    /**
     * Get compromisos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompromisos()
    {
        return $this->compromisos;
    }
}
