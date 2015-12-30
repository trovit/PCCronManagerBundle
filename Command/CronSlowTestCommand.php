<?php

namespace Parsingcorner\CronManagerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

class CronSlowTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cron:slow-test')
            ->setDescription('Test command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $lock = new LockHandler('cron:slow-test');

        if ($lock->lock()) {
            sleep(60);
            $output->write('miu');
        } else {
            return 1;
        }
    }
}
