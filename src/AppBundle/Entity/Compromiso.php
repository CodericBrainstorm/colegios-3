<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Compromiso
 *
 * @ORM\Table(name="compromiso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompromisoRepository")
 */
class Compromiso {

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
     * @Assert\NotBlank(message = "compromiso.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @Assert\NotNull(message = "compromiso.descripcion.not_null")
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @var string
     *
     * @Assert\NotNull(message = "compromiso.indicador.not_null")
     * @ORM\Column(type="text")
     */
    private $indicador;

    /**
     * @var float
     *
     * @Assert\NotNull(message = "compromiso.ponderacion.not_null")
     * @Assert\Type(type="float", message="compromiso.ponderacion.type")
     * @ORM\Column(name="ponderacion", type="float")
     */
    private $ponderacion;

    /**
     * @ORM\OneToMany(targetEntity="CompromisoReal", mappedBy="compromiso")
     */
    private $compromisosReales;

    /**
     * @ORM\ManyToOne(targetEntity="Area", inversedBy="compromisos")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $area;

    /**
     * @ORM\ManyToOne(targetEntity="Sostenedor", inversedBy="compromisos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $sostenedor;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $estado;

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
     * @return Compromiso
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
     * @return Compromiso
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
     * Set indicador
     *
     * @param string $indicador
     * @return Compromiso
     */
    public function setIndicador($indicador) {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return string 
     */
    public function getIndicador() {
        return $this->indicador;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->compromisosReales = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set ponderacion
     *
     * @param float $ponderacion
     * @return Compromiso
     */
    public function setPonderacion($ponderacion)
    {
        $this->ponderacion = $ponderacion;

        return $this;
    }

    /**
     * Get ponderacion
     *
     * @return float 
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }

    /**
     * Add compromisosReales
     *
     * @param \AppBundle\Entity\CompromisoReal $compromisosReales
     * @return Compromiso
     */
    public function addCompromisosReale(\AppBundle\Entity\CompromisoReal $compromisosReales)
    {
        $this->compromisosReales[] = $compromisosReales;

        return $this;
    }

    /**
     * Remove compromisosReales
     *
     * @param \AppBundle\Entity\CompromisoReal $compromisosReales
     */
    public function removeCompromisosReale(\AppBundle\Entity\CompromisoReal $compromisosReales)
    {
        $this->compromisosReales->removeElement($compromisosReales);
    }

    /**
     * Get compromisosReales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompromisosReales()
    {
        return $this->compromisosReales;
    }

    /**
     * Set area
     *
     * @param \AppBundle\Entity\Area $area
     * @return Compromiso
     */
    public function setArea(\AppBundle\Entity\Area $area = null)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return \AppBundle\Entity\Area 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set sostenedor
     *
     * @param \AppBundle\Entity\Sostenedor $sostenedor
     * @return Compromiso
     */
    public function setSostenedor(\AppBundle\Entity\Sostenedor $sostenedor = null)
    {
        $this->sostenedor = $sostenedor;

        return $this;
    }

    /**
     * Get sostenedor
     *
     * @return \AppBundle\Entity\Sostenedor 
     */
    public function getSostenedor()
    {
        return $this->sostenedor;
    }

    /**
     * Set estado
     *
     * @param \AppBundle\Entity\Estado $estado
     * @return Compromiso
     */
    public function setEstado(\AppBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \AppBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
