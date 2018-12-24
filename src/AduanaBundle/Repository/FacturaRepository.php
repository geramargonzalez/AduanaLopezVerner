<?php

namespace AduanaBundle\Repository;

use AduanaBundle\Entity\Factura;

class FacturaRepository extends \Doctrine\ORM\EntityRepository {

    public function GuardarFactura($cli, $fecha, $concepto, $conceptoNumero, $modalidad, $numModalidad, $serie, $numeroSerie, $banco, $importe,$moneda,$total,$bancoModalidad) {

        $fac = new Factura();

        $now = new \DateTime();
        
        if (count($cli) != null) {

            $fac->setIdclietne($cli);

            $dateform = $fecha;

            if ($dateform != $now) {

                $fac->setFechafactura($fecha);
            
            } else {

                $fac->setFechafactura($now);
            }

            //IMPRIMO EL CONCEPTO
            $fac->setConceptoNumero($concepto, $conceptoNumero);

            ////IMPRIMO LA MODALIDAD 
            if ($modalidad == "Cheque Nº") {

                $fac->setModalidadCheque($serie, $numeroSerie, $banco, $importe);
 
            } else if($modalidad == "Transferencia bancaria"){
                
                $fac->setModalidadBanco($modalidad, $bancoModalidad);
                
            } else {

                $fac->setModalidad($modalidad . " " . $numModalidad);
            }

            //IMPRIMO LA MONEDA
            $fac->setMoneda($moneda);

            //IMPRIMO EL TOTAL
            $fac->setTotal($total);

            //Guardo el estado
            $fac->setEstado("activo");
    
            
        }
        
         
        
        return $fac;
        
    }

   
    
}
