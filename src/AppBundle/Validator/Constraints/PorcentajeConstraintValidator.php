<?php

namespace AppBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PorcentajeConstraintValidator extends ConstraintValidator {

    protected $doctrine;

    public function __construct(EntityManager $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function validate($value, Constraint $constraint) {
        $porcentaje = $this->doctrine->getRepository('AppBundle:Area')->getPorcentajeActual();
        if (($porcentaje - $constraint->porcentaje) + $value > 1) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('%num%', (1 - ($porcentaje - $constraint->porcentaje)) * 100)
                    ->addViolation();
        }
    }

}
