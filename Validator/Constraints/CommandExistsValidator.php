<?php

namespace Trovit\CronManagerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Trovit\CronManagerBundle\Model\CommandValidator;

/**
 * Class CommandExistsValidator
 * @package Trovit\CronManagerBundle\Validator\Constraints
 */
class CommandExistsValidator extends ConstraintValidator
{
    /**
     * @var CommandValidator
     */
    private $_commandValidator;

    /**
     * CommandExistsValidator constructor.
     * @param CommandValidator $commandValidator
     */
    public function __construct(CommandValidator $commandValidator)
    {
        $this->_commandValidator = $commandValidator;
    }

    /**
     * Validate a field
     *
     * @param string $command
     * @param Constraint $constraint
     */
    public function validate($command, Constraint $constraint)
    {
        if (!$this->_commandValidator->commandExists($command)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $command)
                ->addViolation();
        }
    }
}