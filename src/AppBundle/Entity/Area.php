<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Area
 *
 * @ORM\Table(name="area",uniqueConstraints={@ORM\UniqueConstraint(name="ano_nombre", columns={"nombre", "ano_id"})})
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
     * @Assert\NotBlank(message = "area.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Assert\NotNull(message = "area.descripcion.not_null")
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @var float
     *
     * @Assert\NotNull(message = "area.ponderacion.not_null")
     * @Assert\Type(type="float", message="area.ponderacion.type")
     * @ORM\Column(type="float")
     */
    private $ponderacion;

    /**
     * @Assert\NotNull(message = "assert.not_null")
     * @ORM\ManyToOne(targetEntity="Ano")
     */
    private $ano;

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
    public function __construct() {
        $this->compromisos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add compromisos
     *
     * @param \AppBundle\Entity\Compromiso $compromisos
     * @return Area
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
     * Set ano
     *
     * @param \AppBundle\Entity\Ano $ano
     * @return Area
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
