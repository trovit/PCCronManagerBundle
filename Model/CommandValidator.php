<?php
namespace Parsingcorner\CronManagerBundle\Model;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class to check if a command exists
 *
 * @package Parsingcorner\CronManagerBundle\Model
 */
class CommandValidator
{
    /**
     * @var Application
     */
    private $_app;

    /**
     * CommandValidator constructor.
     *
     * @param Kernel $kernel
     */
    public function __construct(Kernel $kernel)
    {
        $this->_kernel = $kernel;
        $this->_app = new Application($kernel);
        foreach ($kernel->getBundles() as $bundle) {
            if ($bundle instanceof Bundle) {
                $bundle->registerCommands($this->_app);
            }
        }
    }


    /**
     * Indicates if a command exists
     *
     * @param string $command A command name (i.e.: cache:clear)
     * @return bool
     */
    public function commandExists($command)
    {
        try {
            $this->_app->find($command);
            $exists = true;
        } catch (InvalidArgumentException $e) {
            $exists = false;
        }

        return $exists;
    }

}