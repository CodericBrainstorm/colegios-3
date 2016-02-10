<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SostenedorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombreInstitucion');
        $builder->add('direccion');
        $builder->add('comuna', EntityType::class, array(
            'class' => 'AppBundle:Comuna',
            'choice_label' => 'nombre',
        ));
        $builder->add('tipoInstitucion', EntityType::class, array(
            'class' => 'AppBundle:TipoInstitucion',
            'choice_label' => 'nombre',
        ));
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
