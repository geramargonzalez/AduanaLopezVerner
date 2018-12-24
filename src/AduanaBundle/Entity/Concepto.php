<?php

namespace AduanaBundle\Entity;

/**
 * Concepto
 */
class Concepto
{
    /**
     * @var integer
     */
     private $idconcepto;

    /**
     * @var string
     */
    private $nombreConcepto;

    
    
    /**
     * Get idconcepto
     *
     * @return integer
     */
    public function getIdconcepto()
    {
        return $this->idconcepto;
    }



    /**
     * Set nombreConcepto
     *
     * @param string $nombreConcepto
     *
     * @return Concepto
     */
    public function setNombreConcepto($nombreConcepto)
    {
        $this->nombreConcepto = $nombreConcepto;

        return $this;
    }

    /**
     * Get nombreConcepto
     *
     * @return string
     */
    public function getNombreConcepto()
    {
        return $this->nombreConcepto;
    }
    
    
    
     public function __toString() {
        
       return $this->nombreConcepto;
    
        
     }
 

}
