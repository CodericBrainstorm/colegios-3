<?php

namespace AppBundle\Form\Type;

use AppBundle\Validator\Constraints\PorcentajeConstraint;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AreaType extends AbstractType {

    protected $doctrine;
    protected $tokenStorage;

    public function __construct(EntityManager $doctrine, TokenStorageInterface $tokenStorage) {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombre');
        $builder->add('descripcion');
        $porcentaje = $options['porcentaje']($builder->getForm());
        $builder->add('ponderacion', PercentType::class, ['constraints' => array(new PorcentajeConstraint(array('message' => 'area.ponderacion.porcentaje', 'porcentaje' => $porcentaje, 'porcentaje_total' => $options['porcentaje_total']))),
            'attr' => ['data-help' => 'Puede ingresar hasta ' . ((1.0 - ($options['porcentaje_total'] - $porcentaje)) * 100) . '%']]);
    }

    private function getPorcentaje() {
        $user = $this->tokenStorage->getToken()->getUser();
        $porcentaje = $this->doctrine->getRepository('AppBundle:Area')->getPorcentajeActual($user->getAno()->getId());
        return $porcentaje;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'porcentaje' => function (Form $form) {
                $data = $form->getData();
                if (is_null($data->getId())) {
                    return 0.0;
                }
                return $data->getPonderacion();
            },
            'porcentaje_total' => $this->getPorcentaje()
        ));
    }

}
