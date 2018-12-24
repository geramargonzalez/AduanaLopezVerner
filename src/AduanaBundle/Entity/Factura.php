<?php

namespace AduanaBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Factura
 */
class Factura
{
    /**
     * @var integer
     */
    private $idfactura;

    /**
     * @var \DateTime
     */
    private $fechafactura;

    /**
     * @var string
     */
    private $concepto;
    
    /**
     * @var integer
     */
    private $numeroConcepto;

    /**
     * @var string
     */
    private $modalidad;

    
    /**
     * @var integer
     */
    private $numeroModalidad;
    
    /**
     * @var integer
     */
    private $bancoModalidad;

    /**
     * @var string
     */
    private $moneda;

    /**
     * @var float
     */
    private $total;

    /**
     * @var \AduanaBundle\Entity\Cliente
     */
    private $idclietne;

     /**
     * @var string
     */
    private $serie;
    
      /**
     * @var integer
     */
    private $numeroSerie;
    
      /**
     * @var string
     */
    private $banco;
    
     /**
     * @var integer
     */
    private $importe;
    
     /**
     * @var string
     */
    private $estado;


    private $detallesFactura;
    
    
     public function __construct()
    {
        $this->detallesFactura = new ArrayCollection();
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
     * Set fechafactura
     *
     * @param \DateTime $fechafactura
     *
     * @return Factura
     */
    public function setFechafactura($fechafactura)
    {
        $this->fechafactura = $fechafactura;

        return $this;
    }

    /**
     * Get fechafactura
     *
     * @return \DateTime
     */
    public function getFechafactura()
    {
        return $this->fechafactura;
    }

    /**
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Factura
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }
    
        /**
     * Set concepto
     *
     * @param string $concepto
     *
     * @return Factura
     */
    public function setConceptoNumero($concepto,$numeroConcepto)
    {
        $this->concepto = $concepto . " " . $numeroConcepto;

        return $this;
    }

     public function setModalidadCheque($serie, $numeroSerie,$banco,$importe)
    {
        $this->modalidad = $serie . " " . $numeroSerie . " " . $banco . " importe " . $importe;

        return $this;
    }

    
    /**
     * Get concepto
     *
     * @return string
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    
   /**
     * Set numeroModalidad
     *
     * @param numeroModalidad
     *
     * @return Factura
     */
    public function setnumeroModalidad($num) {
        
        $this->numeroModalidad = $num;

        return $this;
    }

    /**
     * Get numeroConcepto
     *
     * @return numeroConcepto
     */
    public function getnumeroModalidad() {
        return $this->numeroModalidad;
   
    }
    
      /**
     * Set bancoModalidad
     *
     * @param  bancoModalidad
     *
     * @return Factura
     */
    public function setbancoModalidad($bancoM) {
        
        $this->bancoModalalidad = $bancoM;

        return $this;
    }

    /**
     * Get bancoModalidad
     *
     * @return bancoModalidad
     */
    public function getbancoModalidad() {
        return $this->bancoModalidad;
   
    }

    /**
     * Set modalidad
     *
     * @param string $modalidad
     *
     * @return Factura
     */
    public function setModalidad($modalidad)
    {
        $this->modalidad = $modalidad;

        return $this;
    }
    
      
    /**
     * Set modalidad
     *
     * @param string $modalidad
     *
     * @return Factura
     */
    public function setModalidadYNumero($modalidad,$numeroModalidad)
    {
        $this->modalidad = $modalidad . " " . $numeroModalidad;

        return $this;
    }
    
         
    /**
     * Set modalidad
     *
     * @param string $modalidad
     *
     * @return Factura
     */
    public function setModalidadBanco($modalidad,$bancoModalidad)
    {
        $this->modalidad = $modalidad . ": " . $bancoModalidad;

        return $this;
    }

    /**
     * Get modalidad
     *
     * @return string 
     */
    public function getModalidad()
    {
        return $this->modalidad;
    }
    
    
       
   /**
     * Set numeroConcepto
     *
     * @param numeroConcepto
     *
     * @return Factura
     */
    public function setNumeroConcepto($num) {
        $this->numeroConcepto = $num;

        return $this;
    }

    /**
     * Get numeroConcepto
     *
     * @return numeroConcepto
     */
    public function getnumeroConcepto() {
        return $this->numeroConcepto;
    }

    

    /**
     * Set moneda
     *
     * @param string $moneda
     *
     * @return Factura
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return string
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Factura
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set idclietne
     *
     * @param \AduanaBundle\Entity\Cliente $idclietne
     *
     * @return Factura
     */
    public function setIdclietne(\AduanaBundle\Entity\Cliente $idclietne = null)
    {
        $this->idclietne = $idclietne;

        return $this;
    }

    /**
     * Get idclietne
     *
     * @return \AduanaBundle\Entity\Cliente
     */
    public function getIdclietne()
    {
        return $this->idclietne;
    }
    
    
     /**
     * Set serie
     *
     * @param serie
     *
     * @return Factura
     */
      public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }
    
       /**
     * Get serie
     *
     * @return string
     */
    public function getSerie(){
        return $this->serie;
    }
    
      /**
     * Set numeroSerie
     *
     * @param numeroSerie
     *
     * @return Factura
     */
       public function setnumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;

        return $this;
    }
    
    /**
     * Get numeroSerie
     *
     * @return integer
     */
    public function getNumeroSerie(){
        return $this->serie;
    }
    
       /**
     * Set banco
     *
     * @param banco
     *
     * @return Factura
     */
       public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }
    
       /**
     * Get banco
     *
     * @return string
     */
    public function getBanco(){
        return $this->banco;
    }
    
       /**
     * Set importe
     *
     * @param importe
     *
     * @return Factura
     */
       public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }
    
      /**
     * Get importe
     *
     * @return integer
     */
    public function getImporte(){
        return $this->importe;
    }
    
           /**
     * Set estado
     *
     * @param estado
     *
     * @return Factura
     */
       public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
    
       /**
     * Get estado
     *
     * @return string
     */
    public function getEstado(){
        return $this->estado;
    }
    
       
           /**
     * Set estado
     *
     * @param estado
     *
     * @return Factura
     */
       public function setDetallesFactura(ArrayCollection $detallesFactura)
    {
        $this->detallesFactura = $detallesFactura;

        return $this;
    }
    
    /**
     * Get estado
     *
     * @return string
     */
    public function getDetallesFactura(){
         return $this->detallesFactura;
    }
 
}
