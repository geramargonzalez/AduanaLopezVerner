<?php

namespace AduanaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ci', IntegerType::class, array('label'=>'Cedula','required' => "required",
                      'attr'=>array('class' => 'form-name form-control'))
                )
                 ->add('nombre', TextType::class, array('label'=>'Nombre','required' => "required",
                      'attr'=>array('class' => 'form-name form-control'))
                )
                 ->add('apellido', TextType::class, array('label'=>'Apellido','required' => "required",
                      'attr'=>array('class' => 'form-name form-control'))
                )
                 ->add('Guardar', SubmitType::class, array("attr" => array("class" => "form-submit btn btn-success"))
                       );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AduanaBundle\Entity\Cliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aduanabundle_cliente';
    }


}
