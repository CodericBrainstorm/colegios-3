<?php

namespace AppBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AnoSelectType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('ano', EntityType::class, array(
            'class' => 'AppBundle:Ano',
            'choice_label' => 'nombre',
            'property' => 'nombre',
            'label' => 'Trabajando en el año ',
            'attr' => array('class' => 'form-control'),
            'label_attr' => array('class' => 'ano_select_label')
        ));
    }

}
