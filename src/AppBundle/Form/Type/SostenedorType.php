<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Ciudad;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class SostenedorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nombreInstitucion');
        $builder->add('direccion');
        $builder->add('tipoInstitucion', EntityType::class, array(
            'placeholder' => '',
            'class' => 'AppBundle:TipoInstitucion',
            'choice_label' => 'nombre',
        ));
        $builder->add('ciudad', EntityType::class, array(
            'placeholder' => '',
            'class' => 'AppBundle:Ciudad',
            'choice_label' => 'nombre',
        ));

        $formModifier = function (FormInterface $form, Ciudad $ciudad = null) {
            $comunas = null === $ciudad ? array() : $ciudad->getComunas();
            $form->add('comuna', EntityType::class, array('class' => 'AppBundle:Comuna',
//                'placeholder' => '',
                'choice_label' => 'nombre',
                'choices' => $comunas));
        };
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) { // this would be your entity, i.e. SportMeetup 
            $data = $event->getData();
            $formModifier($event->getForm(), $data->getCiudad());
        }
        );
        $builder->get('ciudad')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($formModifier) {
            $ciudad = $event->getForm()->getData();
            $formModifier($event->getForm()->getParent(), $ciudad);
        }
        );
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
