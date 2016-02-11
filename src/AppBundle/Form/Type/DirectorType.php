<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DirectorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('sostenedor', EntityType::class, array(
            'class' => 'AppBundle:Sostenedor',
            'choice_label' => 'nombre',
        ));
        $builder->add('colegio', EntityType::class, array(
            'class' => 'AppBundle:Colegio',
            'choice_label' => 'nombre',
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
