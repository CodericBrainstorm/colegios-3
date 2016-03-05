<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccionType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre');
        $builder->add('descripcion');
        $builder->add('fechaInicio', DateType::class, array(
            'widget' => 'choice',
            'years' => array($options['miembro']->getAno()->getNombre())
        ));
        $builder->add('fechaFin', DateType::class, array(
            'widget' => 'choice',
            'years' => array($options['miembro']->getAno()->getNombre())
        ));
        $builder->add('verificado', CheckboxType::class, array(
            'required' => false
        ));
        $builder->add('miembro', EntityType::class, array(
            'class' => 'AppBundle:Miembro',
            'choice_label' => 'getNombreEntero',
            'read_only' => $options['readonlyMiembro']
        ));
        $builder->add('estadoDirector', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre',
            'read_only' => $options['readonlyEstadoDirector']
        ));
        $builder->add('estadoMiembro', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre',
        ));
        $builder->add('hito', EntityType::class, array(
            'class' => 'AppBundle:Hito',
            'choice_label' => 'nombre',
            'choices' => $options['miembro']->getHitos()
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'miembro' => null,
            'ano' => null,
            'readonlyMiembro' => false,
            'readonlyEstadoDirector' => false
        ));
    }

}
