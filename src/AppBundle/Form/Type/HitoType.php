<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HitoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('compromiso', EntityType::class, array(
            'class' => 'AppBundle:CompromisoReal',
            'choice_label' => 'compromiso.nombre',
            'choices' => $options['director']->getCompromisos()
        ));
        $builder->add('nombre');
        $builder->add('descripcion');
        $builder->add('fechaInicio', DateType::class, array(
            'widget' => 'choice',
            'years' => array($options['director']->getAno()->getNombre())
        ));
        $builder->add('fechaFin', DateType::class, array(
            'widget' => 'choice',
            'years' => array($options['director']->getAno()->getNombre())
        ));
        $builder->add('verificado', CheckboxType::class, array(
            'required' => false
        ));
        $builder->add('estadoSostenedor', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre',
        ));
        $builder->add('estadoDirector', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre'
        ));
        $builder->add('miembros', EntityType::class, array(
            'class' => 'AppBundle:Miembro',
            'choice_label' => 'username',
            'choices' => $options['director']->getMiembros(),
            'multiple' => true
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'director' => null
        ));
    }

}
