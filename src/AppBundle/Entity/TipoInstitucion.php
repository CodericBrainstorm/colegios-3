<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * TipoInstitucion
 *
 * @ORM\Table(name="tipo_institucion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoInstitucionRepository")
 * @UniqueEntity("nombre")
 */
class TipoInstitucion {

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
     * @Assert\NotBlank(message = "tipoInstitucion.nombre.not_blank")
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean")
     */
    private $borrado=false;

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
     * @return TipoInstitucion
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
     * Set borrado
     *
     * @param boolean $borrado
     * @return TipoInstitucion
     */
    public function setBorrado($borrado) {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean 
     */
    public function getBorrado() {
        return $this->borrado;
    }
    
    /**
     * borrar
     *
     * @return TipoInstitucion
     */
    public function borrar() {
        $this->setBorrado(true);
    }
}
