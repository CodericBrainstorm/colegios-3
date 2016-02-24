<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PorcentajeConstraintValidator extends ConstraintValidator {

    public function validate($value, Constraint $constraint) {
        $porcentaje = $constraint->porcentaje_total;
        if (($porcentaje - $constraint->porcentaje) + $value > 1) {
            $this->context->buildViolation($constraint->message)
                    ->setParameter('%num%', (1 - ($porcentaje - $constraint->porcentaje)) * 100)
                    ->addViolation();
        }
    }

}
