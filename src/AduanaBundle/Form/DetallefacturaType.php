<?php

namespace AduanaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class DetallefacturaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('idfactura', IntegerType::class, array('label' => 'Factura',
                    'attr' => array('class' => 'form-name form-control input-sm'))
                )
                ->add('subtotal', IntegerType::class, array('label' => 'Importe',
                    'attr' => array('class' => 'form-name form-control input-sm'))
                );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AduanaBundle\Entity\Detallefactura'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'aduanabundle_detallefactura';
    }



}
