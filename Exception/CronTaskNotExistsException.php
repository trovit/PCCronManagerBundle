<?php
namespace Trovit\CronManagerBundle\Exception;

/**
 * Exception thrown when cron task does not exist
 *
 * @package Trovit\CronManagerBundle\Exception
 */
class CronTaskNotExistsException extends \Exception
{

    /**
     * CronTaskNotExistsException constructor.
     *
     * @param string          $id
     * @param int             $code
     * @param \Exception|null $previous
     */
    public function __construct($id, $code = 0, $previous = null)
    {
        parent::__construct('CronTask with id #'.$id.' doesn\'t exists', $code, $previous);
    }
}
