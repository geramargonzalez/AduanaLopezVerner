<?php

namespace AduanaBundle\Entity;

/**
 * Cliente
 */
class Cliente
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $ci;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ci
     *
     * @param integer $ci
     *
     * @return Cliente
     */
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return integer
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cliente
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Cliente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }
    
      public function __toString() {
        return $this->nombre . " " .$this->apellido ;
    }
}
