<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PorcentajeConstraint extends Constraint {

    public $message = 'The percentage cant be over %num%%.';
    public $porcentaje;
    public $porcentaje_total;

    public function __construct($options = null)
    {
        parent::__construct($options);
        
    }

    public function validatedBy() {
        return 'porcentaje_constraint';
    }

}
