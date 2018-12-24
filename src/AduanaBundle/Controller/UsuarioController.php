<?php

namespace AduanaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AduanaBundle\Entity\Usuario;
use AduanaBundle\Form\UsuarioType;
use AduanaBundle\Form\EditUsuarioType;
use AduanaBundle\Entity\Usuariofactura;

class UsuarioController extends Controller {

    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function loginAction(Request $request) {

        if (is_object($this->getUser())) {
            
            return $this->redirect("home");
                    
        }

        //Llamamos al servicio de autenticacion
        $authenticationUtils = $this->get('security.authentication_utils');

        // conseguir el error del login si falla
        $error = $authenticationUtils->getLastAuthenticationError();

        // ultimo nombre de usuario que se ha intentado identificar
        $lastUsername = $authenticationUtils->getLastUsername();

        if ($error == true) {

            $this->session->getFlashBag()->add("status", "Sus credenciales no son correctas ...");

            $this->session->getFlashBag()->add("exito", false);
        }


        return $this->render("AduanaBundle:Usuario:login.html.twig", array("last_username" => $lastUsername,
                    'error' => $error));
    }

    public function registerAction(Request $request) {

        // Creamos un nuevo usuario
        $user = new Usuario();

        // Creamos el formulario
        $form = $this->createForm(UsuarioType::class, $user);

        // Traemos las peticiones del servidor
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                //$user_repo = $em->getRepository("BackendBundle:User");
                $query = $em->CreateQuery("Select u from AduanaBundle:Usuario u Where u.email = :email")
                        ->setParameter("email", $form->get("email")->getData());

                $user_isset = $query->getResult();

                if (count($user_isset) == 0) {

                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
                    $user->setPassword($password);
                    $user->setNombre($form->get("nombre")->getData());
                    $user->setApellido($form->get("apellido")->getData());

                    $user->setRol("admin");

                    // Capturamos la imagen
                    $file = $form['imagen']->getData();
                    
                    $bio = $form->get("bio")->getData();

                    if (!empty($file) || $file != null) {
                        
                        if (!empty($bio) || $bio != null) {

                        // Obtenemos la extension
                        $ext = $file->guessExtension();

                        // Comparamos  los tipos d extension
                        if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {

                            //Le ponemos un nombre a nuestra imagen
                            $file_name = time() . $user->getIdusuario() . "." . $ext;

                            // y la ubicamos en un fichero
                            $file->move("uploads/usuarios", $file_name);
                            
                            
                            $user->setBio($bio);

                            // seteamos la imagen del usuario
                            $user->setimagen($file_name);

                            $em->persist($user);
                            $flush = $em->flush();

                            if ($flush == null) {

                                //$status = "Te has logeado correctamente";

                                //$this->session->getFlashBag()->add("status", $status);

                                //Llamamos al servicio de autenticacion
                                $authenticationUtils = $this->get('security.authentication_utils');

                                // conseguir el error del login si falla
                                $error = $authenticationUtils->getLastAuthenticationError();
                                
                                 // ultimo nombre de usuario que se ha intentado identificar
                                $lastUsername = $authenticationUtils->getLastUsername();


                                if ($error == true) {

                                    $this->session->getFlashBag()->add("status", "Sus credenciales no son correctas ...");

                                    return $this->redirectToRoute("register");
                                }

                                
                                   if (is_object($this->getUser())) {
            
                                       return $this->redirectToRoute("aduana_homepage");
                                   }

                               return $this->render("AduanaBundle:Usuario:login.html.twig", array("last_username" => $lastUsername,
                                        'error' => $error));
                                
                            } else {

                                $status = "No te has logeado correctamente";
                            }
                        }
                        
                        } else {

                         $status = "Debes completar tu biografia";
                    }
                        
                    } else {

                         $status = "Debes subir una imagen";
                    }
                    
                    
                } else {

                    $status = "El usuario ya existe";
                }
                
            } else {

                $status = "No te has registrado correctamente !!";
            }


            $this->session->getFlashBag()->add("status", $status);
        }

        return $this->render("AduanaBundle:Usuario:add.html.twig", array(
                    "form" => $form->createView()));
    }

    function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $user_repo = $em->getRepository("AduanaBundle:Usuario");
        $user = $user_repo->find($id);

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("blog_ver_user");
    }

    function editAction(Request $request) {


        $cont = 0;
        $camposEdit = false;

        //Cargamos el usuario logeado
        $user = $this->getUser();

        // Creamos el formulario
        $form = $this->createForm(EditUsuarioType::class, null);

        // Bindea el objeto con la request
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();

                if ($form->get("password")->getData() != null) {

                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
                    $user->setPassword($password);
                    $cont++;
                }

                if ($form->get("nombre")->getData() != null) {

                    $user->setNombre($form->get("nombre")->getData());
                    $cont++;
                }

                if ($form->get("apellido")->getData() != null) {

                    $user->setApellido($form->get("apellido")->getData());
                    $cont++;
                }


                if ($form->get("bio")->getData() != null)
                    $user->setBio($form->get("bio")->getData());
                $cont++;
            }
            if ($form->get("email")->getData() != null) {

                $user->setEmail($form->get("email")->getData());
                $cont++;
            }

            $user->setRol("admin");

            // Capturamos la imagen
            $file = $form['imagen']->getData();

            if (!empty($file) || $file != null) {

                // Obtenemos la extension
                $ext = $file->guessExtension();

                // Comparamos  los tipos d extension
                if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'jpeg') {

                    //Le ponemos un nombre a nuestra imagen
                    $file_name = time() . $user->getIdusuario() . "." . $ext;

                    // y la ubicamos en un fichero
                    $file->move("uploads/usuarios", $file_name);

                    // seteamos la imagen del usuario
                    $user->setimagen($file_name);
                    $cont++;
                }
            }

            if ($cont > 0) {

                $em->persist($user);
                $flush = $em->flush();

                if ($flush == null) {

                    $status = "Has editado " . $cont . " campos.";
                    $camposEdit = true;
                } else {

                    $status = "Los cambios no se han podido lograr. ";
                    $camposEdit = true;
                }
            }
        }

        if ($camposEdit) {

            $this->session->getFlashBag()->add("status", $status);
            $this->session->getFlashBag()->add("exito", $camposEdit);
        }

        return $this->render("AduanaBundle:Usuario:edit.html.twig", array(
                    "form" => $form->createView(),
                    "user" => $user)
        );
    }

    function perfilAction() {

        //Cargamos el usuario logeado
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $userfact_repo = $em->getRepository("AduanaBundle:Usuariofactura");
        $user_fact = $userfact_repo->findBy(array("idusuario" => $user->getIdusuario()));
        $cant = count($user_fact);

        return $this->render("AduanaBundle:Usuario:perfil.html.twig", array(
                    "user" => $user,
                    "cantidad" => $cant
                        )
        );
    }

    function usersAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $user_repository = $em->getRepository("AduanaBundle:Usuario");
        $users = $user_repository->findAll();

        return $this->render("AduanaBundle:Usuario:usuarios.html.twig", array(
                    "users" => $users)
        );
    }

}
