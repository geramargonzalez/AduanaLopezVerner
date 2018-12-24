<?php

namespace AduanaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EditUsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombre', TextType::class, array('label'=>'Nombre',
                                                      'required' => false,
                                                       'attr'=>array('class' => 'form-name form-control'))
                        )
                ->add('apellido',TextType::class, array('label'=>'Apellido',
                                                      'required' => false,
                                                       'attr'=>array('class' => 'form-surname form-control')))
                
                ->add('email',EmailType::class, array('label'=>'Email',
                                                      'required' => false,
                                                       'attr'=>array('class' => 'form-email form-control'))
                        )
               
                ->add('password',PasswordType::class, array('label'=>'Passwoord',
                                                      'required' => false,
                                                       'attr'=>array('class' => 'form-passwoord form-control'))
                        )
                ->add('imagen',  FileType::class, array('label'=>'Imagen',
                                                       'required' => false,
                                                       'data_class' => null,
                                                       'attr'=>array('class' => 'form-image form-control custom-file-input'))
                     )
                ->add('bio', TextareaType::class, array('label'=>'Bio',
                                                       'required' => false,
                                                       'data_class' => null,
                                                       'attr'=>array('class' => 'form-control'))
                     )
                ->add('Register', SubmitType::class, array("attr" => array("class" => "form-submit btn btn-warning pull-right"))
                       );
    
                
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AduanaBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aduanabundle_usuario';
    }


}
