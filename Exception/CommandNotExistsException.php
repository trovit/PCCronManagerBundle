<?php

namespace Parsingcorner\CronManagerBundle\Exception;

class CommandNotExistsException extends \Exception
{
    public function __construct($command, $code = 0, $previous = null)
    {
        parent::__construct('Command "' . $command . '" doesn\'t exists', $code, $previous);
    }
}
