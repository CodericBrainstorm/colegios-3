<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DirectorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('sostenedor', EntityType::class, array(
            'class' => 'AppBundle:Sostenedor',
            'choice_label' => 'nombre',
            'read_only' => $options['disabledSostenedor']
        ));
        $builder->add('colegio', EntityType::class, array(
            'placeholder' => '',
            'class' => 'AppBundle:Colegio',
            'choice_label' => 'nombre',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'disabledSostenedor' => false
        ));
    }

    public function getParent() {
        return 'AppBundle\Form\Type\UserType';
    }

    public function getBlockPrefix() {
        return 'app_user_director';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
