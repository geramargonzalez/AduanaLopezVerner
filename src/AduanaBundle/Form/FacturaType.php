<?php

namespace AduanaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AduanaBundle\Form\DetallefacturaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;





class FacturaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder

                ->add('idclietne', EntityType::class, array('label' => 'Recibimos del cliente',
                         'class' => "AduanaBundle:Cliente",
                    'attr' => array('class' => 'form-name form-control'
                  ))
                )
                ->add('fechafactura',  DateType::class, array('label' => 'Fecha del recibos',
                    'widget' => 'single_text',

                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                    'format' => 'dd-MM-yyyy',

                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                ))
                 ->add('moneda', ChoiceType::class, array('label' => 'Moneda', 'required' => "required",
                    'attr' => array('class' => 'form-name form-control'), 'choices' => array(
                        'UYU' => 'pesos', '$' => 'dolares'))
                )
                ->add('concepto', EntityType::class, array('label' => 'Concepto',
                    'class' => "AduanaBundle:Concepto",
                    'attr' => array('class' => 'form-name form-control'))
                )
                ->add('numeroConcepto', IntegerType::class, array('label' => 'Numero concepto', 
                    'attr' => array('class' => 'form-name form-control'))
                )
                ->add('modalidad', EntityType::class, array('label' => 'Modalidad', 'required' => "required",
                    'class' => "AduanaBundle:Modalidad",
                    'attr' => array('class' => 'form-name form-control'))
                )
                ->add('numeroModalidad', IntegerType::class, array('label' => 'Numero modalidad',
                    'attr' => array('class' => 'form-name form-control'))
                )
                 ->add('bancoModalidad', TextType::class, array('label' => 'Nombre banco',
                    'attr' => array('class' => 'form-name form-control'))
                )
                ->add('serie', TextType::class, array('attr' => array('class' => 'form-name form-control '))
                )
                 ->add('numeroSerie', IntegerType::class, array('attr' => array('class' => 'form-name form-control '))
                )
                ->add('banco', TextType::class, array('attr' => array('class' => 'form-name form-control '))
                )
                ->add('importe', IntegerType::class, array('attr' => array('class' => 'form-name form-control '))
                )
                ->add('detallesFactura', CollectionType::class, array('entry_type' => DetallefacturaType::class,
                   'allow_add'    => true,
                   'by_reference' => false,
                   'allow_delete' => true)
                )
                ->add('total', MoneyType::class, array('label' => 'Total ',
                    'attr' => array('class' => 'form-name form-control', "value"=>'0'))
                )
                ->add('save', SubmitType::class, array('label' => 'Guardar', "attr" => array("class" => "form-submit btn btn-success pull-right"))
                );
         
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AduanaBundle\Entity\Factura',
           
            
        ));
         
        $resolver->setDefaults(['required' => false,]); 
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'aduanabundle_factura';
    }

}
