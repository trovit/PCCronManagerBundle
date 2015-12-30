<?php

namespace Parsingcorner\CronManagerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CronManagerCommand extends ContainerAwareCommand
{
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('parsingcorner.cron_manager.cron_dispatcher')->executeCrons(
            $input->getOption('daemon')
        );
    }
}
