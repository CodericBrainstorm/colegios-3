<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SostenedorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombreInstitucion');
        $builder->add('direccion');
    }

    public function getParent() {
        return 'AppBundle\Form\Type\UserType';
    }

    public function getBlockPrefix() {
        return 'app_user_sostenedor';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
