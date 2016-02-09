<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Colegio
 *
 * @ORM\Table(name="colegio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ColegioRepository")
 */
class Colegio {

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
     * @Assert\NotBlank(message = "colegio.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="TipoColegio")
     */
    private $tipoColegio;

    /**
     * @ORM\OneToOne(targetEntity="Director", inversedBy="colegio")
     */
    private $director;

    /**
     * @ORM\OneToMany(targetEntity="Miembro", mappedBy="colegio")
     */
    private $miembros;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->miembros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Colegio
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
     * Set tipoColegio
     *
     * @param \AppBundle\Entity\TipoColegio $tipoColegio
     * @return Colegio
     */
    public function setTipoColegio(\AppBundle\Entity\TipoColegio $tipoColegio = null)
    {
        $this->tipoColegio = $tipoColegio;

        return $this;
    }

    /**
     * Get tipoColegio
     *
     * @return \AppBundle\Entity\TipoColegio 
     */
    public function getTipoColegio()
    {
        return $this->tipoColegio;
    }

    /**
     * Set director
     *
     * @param \AppBundle\Entity\Director $director
     * @return Colegio
     */
    public function setDirector(\AppBundle\Entity\Director $director = null)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \AppBundle\Entity\Director 
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Add miembros
     *
     * @param \AppBundle\Entity\Miembro $miembros
     * @return Colegio
     */
    public function addMiembro(\AppBundle\Entity\Miembro $miembros)
    {
        $this->miembros[] = $miembros;

        return $this;
    }

    /**
     * Remove miembros
     *
     * @param \AppBundle\Entity\Miembro $miembros
     */
    public function removeMiembro(\AppBundle\Entity\Miembro $miembros)
    {
        $this->miembros->removeElement($miembros);
    }

    /**
     * Get miembros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMiembros()
    {
        return $this->miembros;
    }
}
