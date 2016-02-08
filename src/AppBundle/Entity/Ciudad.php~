<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CiudadRepository")
 */
class Ciudad {

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
     * @Assert\NotBlank(message = "ciudad.nombre.not_blank")
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Comuna", mappedBy="ciudad")
     */
    private $comunas;

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
     * @return Ciudad
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
     * Constructor
     */
    public function __construct()
    {
        $this->comunas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comunas
     *
     * @param \AppBundle\Entity\Comuna $comunas
     * @return Ciudad
     */
    public function addComuna(\AppBundle\Entity\Comuna $comunas)
    {
        $this->comunas[] = $comunas;

        return $this;
    }

    /**
     * Remove comunas
     *
     * @param \AppBundle\Entity\Comuna $comunas
     */
    public function removeComuna(\AppBundle\Entity\Comuna $comunas)
    {
        $this->comunas->removeElement($comunas);
    }

    /**
     * Get comunas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComunas()
    {
        return $this->comunas;
    }
}
