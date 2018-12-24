<?php

namespace AduanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AduanaBundle\Entity\Cliente;
use AduanaBundle\Form\ClienteType;

class ClienteController extends Controller
{
    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    

    public function addAction(Request $request)
    {
        // Creamos el objeto Tag y se lo pasamos al Formulario de creacion 
        $cli = new Cliente();

        $form = $this->createForm(ClienteType::class, $cli);

        $form->handleRequest($request);
        
        $status = "";
        
        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getEntityManager();
                $cat_repository = $em->getRepository("AduanaBundle:Cliente");
                $cliente = $cat_repository->findOneBy(array("ci" => $form->get('ci')->getData()));

                if (count($cliente) == 0) {

                    $cli = new Cliente();
                    $cli->setCi($form->get('ci')->getData());
                    $cli->setNombre($form->get('nombre')->getData());
                    $cli->setApellido($form->get('apellido')->getData());


                    $em = $this->getDoctrine()->getEntityManager();
                    $em->persist($cli);
                    $flush = $em->flush();

                    if ($flush == null) {

                        $status = "El cliente se ha creado correctamente";
                    } else {

                        $status = "El cliente no se ha creado correctamente";
                    }
                }
            } else {

                $status = "El cliente ya esta ingresado en el sistema";
            }


            $this->session->getFlashBag()->add("status", $status);

            return $this->redirectToRoute("blog_index_cli");
        }

        return $this->render('AduanaBundle:Cliente:add.html.twig',array(
                    'form' => $form->createView()
                ));
    }
    
    
    
    function indexAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $cli_repository = $em->getRepository("AduanaBundle:Cliente");
        $clis =  $cli_repository->findAll();

        return $this->render('AduanaBundle:Cliente:index.html.twig', array(
                    'clis' => $clis
        ));
    }
    
       function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $cli_repo = $em->getRepository("AduanaBundle:Cliente");
        $cli = $cli_repo->find($id);
        
        $fac_repo = $em->getRepository("AduanaBundle:Factura");
        $facs = $fac_repo->findBy(array("idclietne" => $cli));
        
        foreach ($facs as $fac){
            $em->remove($fac);
            $em->flush();
        }

        
        $em->remove($cli);
        $em->flush();

        return $this->redirectToRoute("blog_index_cli");
    }

}
