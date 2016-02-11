<?php

namespace Trovit\CronManagerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Trovit\CronManagerBundle\Model\CronExpressionWrapper;

/**
 * Class ValidCronExpressionValidator
 * @package Trovit\CronManagerBundle\Validator\Constraints
 */
class ValidCronExpressionValidator extends ConstraintValidator
{
    /**
     * @var CronExpressionWrapper
     */
    private $_cronExpressionWrapper;

    /**
     * ValidCronExpressionValidator constructor.
     * @param CronExpressionWrapper $cronExpressionWrapper
     */
    public function __construct(CronExpressionWrapper $cronExpressionWrapper)
    {
        $this->_cronExpressionWrapper = $cronExpressionWrapper;
    }

    /**
     * Validate a field
     *
     * @param string $cronExpression
     * @param Constraint $constraint
     */
    public function validate($cronExpression, Constraint $constraint)
    {
        if (!$this->_cronExpressionWrapper->isValidExpression($cronExpression)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $cronExpression)
                ->addViolation();
        }
    }
}