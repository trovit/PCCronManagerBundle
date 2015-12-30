<?php
namespace Parsingcorner\CronManagerBundle\Exception;

/**
 * Exception thrown when a command does not exists
 *
 * @package Parsingcorner\CronManagerBundle\Exception
 */
class CommandNotExistsException extends \Exception
{

    /**
     * CommandNotExistsException constructor.
     *
     * @param string         $command Command string
     * @param int            $code
     * @param null|Exception $previous
     */
    public function __construct($command, $code = 0, $previous = null)
    {
        parent::__construct('Command "'.$command.'" doesn\'t exists', $code, $previous);
    }
}
