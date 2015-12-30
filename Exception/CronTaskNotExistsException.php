<?php

namespace Parsingcorner\CronManagerBundle\Exception;

class CronTaskNotExistsException extends \Exception
{
    public function __construct($id, $code = 0, $previous = null)
    {
        parent::__construct('CronTask with id #' . $id. ' doesn\'t exists', $code, $previous);
    }
}
