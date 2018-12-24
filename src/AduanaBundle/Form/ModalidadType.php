<?php

namespace AduanaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModalidadType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('nombreModalidad', TextType::class, array('attr' => array('class' => 'form-name form-control '))
                    )
                 ->add('save', SubmitType::class, array('label' => 'Guardar', "attr" => array("class" => "form-submit btn btn-success pull-left"))
                    );
                
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AduanaBundle\Entity\Modalidad'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aduanabundle_modalidad';
    }


}
