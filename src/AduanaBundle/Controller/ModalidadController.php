<?php

namespace AduanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AduanaBundle\Entity\Modalidad;
use AduanaBundle\Form\ModalidadType;


class ModalidadController extends Controller
{
   
    public function addAction(Request $request)
    {
        // Creamos el objeto Tag y se lo pasamos al Formulario de creacion 
        $mod = new Modalidad();
        
         $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(ModalidadType::class, $mod);

        $form->handleRequest($request);
        
        $status = "";
        
        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                    $mod->setNombreModalidad($form->get('nombreModalidad')->getData());

                    $em->persist($mod);
                    $flush = $em->flush();

                    if ($flush == null) {

                        $status = "La modalidad se ha creado correctamente";
                        
                    } else {

                        $status = "La modalidad no se ha podido guardar en la base de datos";
                    }
               
            } else {

                $status = "El formulario no es valido. Intentelo de nuevo";
            }


           // $this->session->getFlashBag()->add("status", $status);

            return $this->redirectToRoute("blog_ver_mod");
        }

        return $this->render('AduanaBundle:Modalidad:modalidad.html.twig',array(
                    'form' => $form->createView()
                ));
    }
    
    
    
    function indexAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $mod_repository = $em->getRepository("AduanaBundle:Modalidad");
        $mod =  $mod_repository->findAll();

        return $this->render('AduanaBundle:Modalidad:modalidades.html.twig', array(
                    'mods' => $mod
        ));
    }
    
    
    function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $mod_repo = $em->getRepository("AduanaBundle:Modalidad");
        $mod = $mod_repo->find($id);

        $em->remove($mod);
        $em->flush();

        return $this->redirectToRoute("blog_ver_mod");
    }

}
