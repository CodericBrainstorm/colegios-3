<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompromisoRealType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('verificado', CheckboxType::class, array(
            'required' => false
        ));
        $builder->add('compromiso', EntityType::class, array(
            'class' => 'AppBundle:Compromiso',
            'choice_label' => 'nombre',
            'choices' => $options['sostenedor']->getCompromisos()
        ));
        
        $builder->add('estadoSostenedor', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre',
        ));
        $builder->add('estadoDirector', EntityType::class, array(
            'class' => 'AppBundle:Estado',
            'choice_label' => 'nombre',
            'read_only' => true
        ));
        $builder->add('director', EntityType::class, array(
            'class' => 'AppBundle:Director',
            'choice_label' => 'nombre',
            'choices' => $options['sostenedor']->getDirectores()
        ));
        $builder->add('medioVerificacion', ArchivoType::class, array(
            'file_path' => $options['file_path']
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'sostenedor' => null,
            'file_path' => null
        ));
    }

}
