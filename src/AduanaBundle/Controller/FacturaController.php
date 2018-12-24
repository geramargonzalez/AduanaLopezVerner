<?php

namespace AduanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AduanaBundle\Entity\Factura;
use AduanaBundle\Form\FacturaType;
use Symfony\Component\HttpFoundation\Response;
use AduanaBundle\Entity\Detallefactura;
use AduanaBundle\Entity\Usuariofactura;


class FacturaController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function addAction(Request $request) {

        $em = $this->getDoctrine()->getEntityManager();

        //Obtengo el usuario logeado
        //$user = $this->getUser();
        // Creamos el objeto Factura y le paso la fecha actuar
        $fac = new Factura();

        $now = new \DateTime();
        $now->format('dd-mm-yyyy');


        $fac->setFechafactura($now);

        $form = $this->createForm(FacturaType::class, $fac);

        $form->handleRequest($request);

        $status = "";

        if ($form->isSubmitted()) {

            if ($form->isValid()) {
     
                // Busco el repositorio de la Factura
                $factura_repository = $em->getRepository("AduanaBundle:Factura");

                $fac = $factura_repository->GuardarFactura($form->get('idclietne')->getData(), $form->get('fechafactura')->getData(), $form->get('concepto')->getData(), $form->get('numeroConcepto')->getData(), $form->get('modalidad')->getData(), $form->get('numeroModalidad')->getData(), $form->get('serie')->getData(), $form->get('numeroSerie')->getData(), $form->get('banco')->getData(), $form->get('importe')->getData(), $form->get('moneda')->getData(), $form->get('total')->getData(), $form->get('bancoModalidad')->getData());

                if ($fac != null && is_object($fac)) {

                    $em->persist($fac);
                    $flush = $em->flush();

                    if ($flush == null) {

                        $dets = $form->get('detallesFactura')->getData();

                        foreach ($dets as $det) {

                            $detalleFac = new Detallefactura();
                            $detalleFac->setIdfactura($det->getIdfactura() + $fac->getIdfactura());
                            $detalleFac->setSubtotal($det->getSubtotal());
                            $em->persist($detalleFac);
                            $fact_usu = new Usuariofactura();
                            $user = $this->getUser();
                            $fact_usu->setIdusuario($user->getIdusuario());
                            $fact_usu->setIdfactura($fac->getIdfactura());
                            $em->persist($fact_usu);
                            $flush = $em->flush();
                        }

                        if ($flush == null) {

                           
                            $flush = $em->flush();

                            if ($flush == null) {

                                $status = "El recibo se ha creado correctamente";
                            
                                
                            } else {

                                $status = "La factura no se han podido guardar";
                            }
                            
                        } else {

                            $status = "La factura no se han podido guardar";
                        }
                        
                    } else {

                        $status = "La factura  no se ha creado correctamente";
                    }
                } else {

                    $status = " La factura no se pudo guardar";
                }


               $this->session->getFlashBag()->add("status", $status);
               
              }
            
            
        }



        return $this->render('AduanaBundle:Factura:add.html.twig', array(
                    'form' => $form->createView(),
                     "id"  => $fac->getIdfactura()
        ));
    }

    public function buscarClienteAction(Request $request) {

        $ci = $request->get("idclietne");
        $em = $this->getDoctrine()->getManager();
        $cli_repo = $em->getRepository("BackendBundle:Cliente");
        $cli = $cli_repo->findOneBy(array("ci" => $ci));

        $result = "";

        if (count($cli) >= 1 && is_object($cli)) {

            $result = $cli[0] . ci;
        
            
        } else {

            $result = "No se encontro el cliente";
        }

        return new Response($result);
    }
    
    public function indexAction(){
        
         $em = $this->getDoctrine()->getEntityManager();
         $fac_repo = $em->getRepository("AduanaBundle:Factura");
         $facs = $fac_repo->findAll();
         
        return $this->render('AduanaBundle:Factura:facturas.html.twig', array(
                     "facs"  => $facs
        ));
    }
    
    public function anularAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $fac_repo = $em->getRepository("AduanaBundle:Factura");
        $fac = $fac_repo->findOneBy(array("idfactura" => $id));


        if ($fac != null) {

            $fac->setEstado("anulado");
            $em->persist($fac);
            $flush = $em->flush();

            if ($flush === null) {

                $status = "La factura se ha editado anulado correctamente";
            
                
            } else {

                $status = "La categoria se ha editado correctamente";
           
                }
                
        } else {

            $status = "El id no se encuentra la BD";
        }


        $this->session->getFlashBag()->add("status", $status);

       return $this->redirectToRoute("blog_verAnul_fac");
    }

    public function anuladasAction(){
        
         $em = $this->getDoctrine()->getEntityManager();
         $fac_repo = $em->getRepository("AduanaBundle:Factura");
         $facs = $fac_repo->findAll();

        return $this->render('AduanaBundle:Factura:facturasAnuladas.html.twig', array(
                     "facs"  => $facs
        ));
    }
    
    public function imprimirAction($id){
        
         $em = $this->getDoctrine()->getEntityManager();
         
         $fac_repo = $em->getRepository("AduanaBundle:Factura");
         //levanto la factura
         $fac = $fac_repo->find($id);
         
         //Levanto los detalles de factura
         $facdet_repo = $em->getRepository("AduanaBundle:Detallefactura");
         $detfacs = $facdet_repo->findBy(array("idfactura" => 500 + $id));

        return $this->render('AduanaBundle:Factura:imprimir.html.twig', array(
                     "fac"  => $fac,
                     "detalles" => $detfacs
        ));
    }
    
    public function reservarAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $fac_repo = $em->getRepository("AduanaBundle:Factura");
        $fac = $fac_repo->findOneBy(array("idfactura" => $id));

        if ($fac != null) {

            $fac->setEstado("reservada");
            $em->persist($fac);
            $flush = $em->flush();

            if ($flush === null) {

                $status = "La factura se ha editado anulado correctamente";
            
                
            } else {

                $status = "La categoria se ha editado correctamente";
           
                }
                
        } else {

            $status = "El id no se encuentra la BD";
        }


        $this->session->getFlashBag()->add("status", $status);

        return $this->redirectToRoute("blog_verRes_fac");
    }
    
    public function activarAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $fac_repo = $em->getRepository("AduanaBundle:Factura");
         $fac = $fac_repo->findOneBy(array("idfactura" => $id));


        if ($fac != null) {

            $fac->setEstado("activo");
            $em->persist($fac);
            $flush = $em->flush();

            if ($flush === null) {

                $status = "La factura se ha editado anulado correctamente";
            
                
            } else {

                $status = "La categoria se ha editado correctamente";
           
                }
                
        } else {

            $status = "El id no se encuentra la BD";
        }


        $this->session->getFlashBag()->add("status", $status);

        return $this->redirectToRoute("blog_ver_fac");
    }

    public function reservadasAction(){
        
         $em = $this->getDoctrine()->getEntityManager();
         $fac_repo = $em->getRepository("AduanaBundle:Factura");
         $facs = $fac_repo->findAll();

        return $this->render('AduanaBundle:Factura:facturasReservadas.html.twig', array(
                     "facs"  => $facs
        ));
    }


}
