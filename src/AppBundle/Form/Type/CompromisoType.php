<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Sostenedor;
use AppBundle\Entity\Area;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PercentType;

class CompromisoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre');
        $builder->add('descripcion');
        $builder->add('indicador');
        $builder->add('area', EntityType::class, array(
            'class' => 'AppBundle:Area',
            'choice_label' => 'nombre',
        ));
        $builder->add('sostenedor', EntityType::class, array(
            'class' => 'AppBundle:Sostenedor',
            'choice_label' => 'nombre',
        ));
    }
}
