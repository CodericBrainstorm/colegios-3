<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdministradorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
    }

    public function getParent() {
        return 'AppBundle\Form\Type\UserType';
    }

    public function getBlockPrefix() {
        return 'app_user_administrador';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
