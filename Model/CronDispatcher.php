<?php
namespace Parsingcorner\CronManagerBundle\Model;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\ReadCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\UpdateCronTask;

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
     * @var int
     */
    private $_checkInterval;


    /**
     * CronDispatcher constructor.
     *
     * @param ReadCronTask   $readCronTask
     * @param UpdateCronTask $updateCronTask
     * @param CommandExecute $commandExecute
     * @param int            $checkInterval Interval in seconds
     */
    public function __construct(
        ReadCronTask $readCronTask,
        UpdateCronTask $updateCronTask,
        CommandExecute $commandExecute,
        $checkInterval
    ) {
        $this->_readCronTask = $readCronTask;
        $this->_updateCronTask = $updateCronTask;
        $this->_commandExecute = $commandExecute;
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
        if (is_null($cronTask->getLastRun())) {
            $this->_executeCommand($cronTask);
        } else {
            $nextRun = $cronTask->getLastRun()->add(new \DateInterval($cronTask->getInterval()));
            if ($nextRun <= new \DateTime()) {
                $this->_executeCommand($cronTask);
            }
        }
    }

    /**
     * @param TblCronTask $cronTask
     */
    private function _executeCommand(TblCronTask $cronTask)
    {
        $this->_commandExecute->executeBackgroundCommand($cronTask->getCommand());
        $this->_updateCronTask->updateLastRun($cronTask, new \DateTime());
    }

}