<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Miembro
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MiembroRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Miembro extends User {

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Director", inversedBy="miembros")
     */
    private $director;

    /**
     * @ORM\ManyToOne(targetEntity="Colegio", inversedBy="miembros")
     */
    private $colegio;

    /**
     * @ORM\ManyToMany(targetEntity="Hito", mappedBy="miembros")
     */
    private $hitos;

    /**
     * @ORM\OneToMany(targetEntity="Accion", mappedBy="miembro")
     */
    private $acciones;

    /**
     * Constructor
     */
    public function __construct() {
        $this->hitos = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct();
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist() {
        $this->addRole("ROLE_MIEMBRO");
    }

    /**
     * Set director
     *
     * @param \AppBundle\Entity\Director $director
     * @return Miembro
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
     * Set nombre
     *
     * @param string $nombre
     * @return Miembro
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
     * @return Miembro
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
     * Set colegio
     *
     * @param \AppBundle\Entity\Colegio $colegio
     * @return Miembro
     */
    public function setColegio(\AppBundle\Entity\Colegio $colegio = null) {
        $this->colegio = $colegio;

        return $this;
    }

    /**
     * Get colegio
     *
     * @return \AppBundle\Entity\Colegio 
     */
    public function getColegio() {
        return $this->colegio;
    }

    /**
     * Add hitos
     *
     * @param \AppBundle\Entity\Hito $hitos
     * @return Miembro
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
     * Add acciones
     *
     * @param \AppBundle\Entity\Accion $acciones
     * @return Miembro
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
    


    public function getType() {
        return \AppBundle\Form\Type\MiembroType::class;
    }

}
