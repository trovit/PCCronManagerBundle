<?php
namespace Parsingcorner\CronManagerBundle\Model;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\ReadCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\UpdateCronTask;

/**
 * Class to execute registered cron tasks
 *
 * @package Parsingcorner\CronManagerBundle\Model
 */
class CronDispatcher
{
    /**
     * @var ReadCronTask
     */
    private $_readCronTask;
    /**
     * @var UpdateCronTask
     */
    private $_updateCronTask;
    /**
     * @var CommandExecute
     */
    private $_commandExecute;
    /**
     * @var CronExpressionWrapper
     */
    private $_cronExpressionWrapper;
    /**
     * @var int
     */
    private $_checkInterval;


    /**
     * CronDispatcher constructor.
     *
     * @param ReadCronTask          $readCronTask
     * @param UpdateCronTask        $updateCronTask
     * @param CommandExecute        $commandExecute
     * @param CronExpressionWrapper $cronExpressionWrapper
     * @param int                   $checkInterval Interval in seconds
     */
    public function __construct(
        ReadCronTask $readCronTask,
        UpdateCronTask $updateCronTask,
        CommandExecute $commandExecute,
        CronExpressionWrapper $cronExpressionWrapper,
        $checkInterval
    ) {
        $this->_readCronTask = $readCronTask;
        $this->_updateCronTask = $updateCronTask;
        $this->_commandExecute = $commandExecute;
        $this->_cronExpressionWrapper = $cronExpressionWrapper;
        $this->_checkInterval = $checkInterval;
    }

    /**
     * Execute crons
     *
     * @param bool $daemon If true, it will execute indefinitely
     */
    public function executeCrons($daemon)
    {
        do {
            $activeCronTasks = $this->_readCronTask->getActiveCronTasks();
            foreach ($activeCronTasks as $cronTask) {
                $this->_checkCronTask($cronTask);
            }
            if ($daemon) {
                sleep($this->_checkInterval);
            }
        } while ($daemon);
    }

    /**
     * Checks a CronTask
     *
     * @param TblCronTask $cronTask
     */
    private function _checkCronTask(TblCronTask $cronTask)
    {
        if ($this->_cronExpressionWrapper->createCronExpression($cronTask->getCronExpression())->isDue()) {
            $this->_startTask($cronTask);
        }
    }

    /**
     * Starts the cron task
     *
     * @param TblCronTask $cronTask
     */
    private function _startTask(TblCronTask $cronTask)
    {
        $this->_commandExecute->executeBackgroundCommand($cronTask->getCommand());
        $this->_updateCronTask->updateLastRun($cronTask, new \DateTime());
    }

}