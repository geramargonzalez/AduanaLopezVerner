<?php

namespace AduanaBundle\Entity;

/**
 * Modalidad
 */
class Modalidad
{
    /**
     * @var integer
     */
    private $idmodalidad;

    

    /**
     * @var string
     */
    private $nombreModalidad;


    /**
     * Get idmodalidad
     *
     * @return integer
     */
    public function getIdmodalidad()
    {
        return $this->idmodalidad;
    }

    

    /**
     * Set nombreModalidad
     *
     * @param string $nombreModalidad
     *
     * @return Modalidad
     */
    public function setNombreModalidad($nombreModalidad)
    {
        $this->nombreModalidad = $nombreModalidad;

        return $this;
    }

    /**
     * Get nombreModalidad
     *
     * @return integer
     */
    public function getNombreModalidad()
    {
        return $this->nombreModalidad;
    }
    
       public function __toString() {
        return $this->nombreModalidad;
    }
    /**
     * @var string
     */
    private $nombremodalidad;


}
