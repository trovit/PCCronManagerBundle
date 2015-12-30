<?php

namespace Parsingcorner\CronManagerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CronTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:test')
            ->setDescription('Test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('miu');
    }
}
