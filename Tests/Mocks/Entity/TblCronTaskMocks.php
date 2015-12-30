<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Entity;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;

/**
 * TblCronTask Mocks generator
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Mocks\Entity
 */
class TblCronTaskMocks
{

    /**
     * @return \Parsingcorner\CronManagerBundle\Entity\TblCronTask
     */
    public function getBasicMock()
    {
        return new TblCronTask();
    }

    /**
     * @param string         $name
     * @param string         $description
     * @param string         $command
     * @param string         $interval
     * @param null|\DateTime $lastRun
     * @return TblCronTask
     */
    public function getCustomMock($name, $description, $command, $interval, $lastRun = null)
    {
        $mock = $this->getBasicMock();
        $mock
            ->setName($name)
            ->setDescription($description)
            ->setCommand($command)
            ->setInterval($interval)
            ->setLastRun($lastRun);

        return $mock;
    }
}