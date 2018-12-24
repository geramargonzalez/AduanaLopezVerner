<?php

namespace AduanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AduanaBundle\Entity\Concepto;
use AduanaBundle\Form\ConceptoType;
use Symfony\Component\HttpFoundation\Session\Session;


class ConceptoController extends Controller
{
    
    private $session;

    public function __construct() {
        $this->session = new Session();
    }


    public function addAction(Request $request)
    {
       
        $con = new Concepto();

        $form = $this->createForm(ConceptoType::class, $con);

        $form->handleRequest($request);
        
        $status = "";
        
        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                
                    $con->setNombreConcepto($form->get('nombreConcepto')->getData());

                    $em->persist($con);
                    $flush = $em->flush();

                    if ($flush == null) {

                        $status = "El concepto se ha creado correctamente";
                    
                        
                    } else {

                        $status = "El concepto no se ha podido persistir en la base de datos";
                    }
                
                    
                    }
                    
                 $this->session->getFlashBag()->add("status", $status);
                
                 return $this->redirectToRoute("blog_ver_con");

            } else {

                $status = "El formulario no es valido. Intentelo de nuevo";
            }



        return $this->render('AduanaBundle:Concepto:concepto.html.twig',array(
                    'form' => $form->createView()
                ));
    }
    
    
    
    function indexAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $con_repository = $em->getRepository("AduanaBundle:Concepto");
        $con =  $con_repository->findAll();

        return $this->render('AduanaBundle:Concepto:conceptos.html.twig', array(
                    'conceptos' => $con
        ));
    }
    
    function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $con_repo = $em->getRepository("AduanaBundle:Concepto");
        $con = $con_repo->find($id);

        $em->remove($con);
        $em->flush();

         return $this->redirectToRoute("blog_ver_con");
        
    }

}
