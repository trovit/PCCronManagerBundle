<?php

namespace Trovit\CronManagerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class CommandExists
 * @package Trovit\CronManagerBundle\Validator\Constraints
 */
class CommandExists extends Constraint
{
    /**
     * @var string
     */
    public $message = "The command doesn't exists";

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'command_exists_validator';
    }
}