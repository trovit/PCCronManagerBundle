<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Entity;

use Trovit\CronManagerBundle\Entity\TblCronTask;

/**
 * TblCronTask Mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Entity
 */
class TblCronTaskMocks
{

    /**
     * @return \Trovit\CronManagerBundle\Entity\TblCronTask
     */
    public function getBasicMock()
    {
        return new TblCronTask();
    }

    /**
     * @param string         $name
     * @param string         $description
     * @param string         $command
     * @param string         $cronExpression
     * @param null|\DateTime $lastRun
     * @return TblCronTask
     */
    public function getCustomMock($name, $description, $command, $cronExpression, $lastRun = null)
    {
        $mock = $this->getBasicMock();
        $mock
            ->setName($name)
            ->setDescription($description)
            ->setCommand($command)
            ->setCronExpression($cronExpression)
            ->setLastRun($lastRun);

        return $mock;
    }
}