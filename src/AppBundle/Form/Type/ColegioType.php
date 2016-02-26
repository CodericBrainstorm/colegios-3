<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ColegioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre');
        $builder->add('tipoColegio', EntityType::class, array(
            'class' => 'AppBundle:TipoColegio',
            'choice_label' => 'nombre',
        ));
        $builder->add('director', EntityType::class, array(
            'placeholder' => '',
            'class' => 'AppBundle:Director',
            'choice_label' => 'nombre',
        ));
    }

}
