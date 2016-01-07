<?php

namespace Trovit\CronManagerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to start cron manager
 *
 * @package Trovit\CronManagerBundle\Command
 */
class CronManagerCommand extends ContainerAwareCommand
{

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('cron:execute')
            ->addOption(
                'daemon',
                'd',
                InputOption::VALUE_NONE,
                'Executes the command in daemon mode. This means the command will run indefinitely.'
            )
            ->setDescription('Checks and execute registred crons');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('trovit.cron_manager.cron_dispatcher')->executeCrons(
            $input->getOption('daemon')
        );
    }
}
