<?php

namespace AppBundle\Form\Type;

use AppBundle\Validator\Constraints\PorcentajeConstraint;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AreaType extends AbstractType {

    protected $doctrine;

    public function __construct(EntityManager $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre');
        $builder->add('descripcion');
        $builder->add('ponderacion', PercentType::class, ['constraints' => array(new PorcentajeConstraint(array('message' => 'area.ponderacion.porcentaje', 'porcentaje' => $options['porcentaje']))),
            'attr' => ['data-help' => 'Puede ingresar hasta ' . ((1 - ($options['porcentaje_total'] - $options['porcentaje'])) * 100) . '%']]);
    }

    private function getPorcentaje() {
        $porcentaje = $this->doctrine->getRepository('AppBundle:Area')->getPorcentajeActual();
        return $porcentaje;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'porcentaje' => 0.0,
            'porcentaje_total' => $this->getPorcentaje(),
            'validation_groups' => function (Form $form) {
                $data = $form->getData();
                if (is_null($data->getId())) {
                    return array('Default', 'crear');
                }
                return array('Default', 'editar');
            }
                ));
            }

        }
        