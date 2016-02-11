<?php

namespace Trovit\CronManagerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CommandExists
 * @package Trovit\CronManagerBundle\Validator\Constraints
 */
class ValidCronExpression extends Constraint
{
    /**
     * @var string
     */
    public $message = "The cron expression is not valid";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'valid_cron_expresion_validator';
    }
}