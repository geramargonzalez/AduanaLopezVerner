<?php

namespace AduanaBundle\Entity;

/**
 * Usuariofactura
 */
class Usuariofactura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $idfactura;

    /**
     * @var integer
     */
    private $idusuario;


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
     * Set idfactura
     *
     * @param integer $idfactura
     *
     * @return Usuariofactura
     */
    public function setIdfactura($idfactura)
    {
        $this->idfactura = $idfactura;

        return $this;
    }

    /**
     * Get idfactura
     *
     * @return integer
     */
    public function getIdfactura()
    {
        return $this->idfactura;
    }

    /**
     * Set idusuario
     *
     * @param integer $idusuario
     *
     * @return Usuariofactura
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get idusuario
     *
     * @return integer
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }
}

