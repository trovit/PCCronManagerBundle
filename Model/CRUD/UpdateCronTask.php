<?php
namespace Parsingcorner\CronManagerBundle\Model\CRUD;

use Doctrine\ORM\EntityManager;
use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Exception\CommandNotExistsException;
use Parsingcorner\CronManagerBundle\Model\CommandValidator;

/**
 * Model to update existing cron tasks
 *
 * @package Parsingcorner\CronManagerBundle\Model\CRUD
 */
class UpdateCronTask
{
    /**
     * @var EntityManager
     */
    private $_entityManager;
    /**
     * @var CommandValidator
     */
    private $_commandValidator;

    /**
     * UpdateCronTask constructor.
     *
     * @param EntityManager    $entityManager
     * @param CommandValidator $commandValidator
     */
    public function __construct(EntityManager $entityManager, CommandValidator $commandValidator)
    {
        $this->_entityManager = $entityManager;
        $this->_commandValidator = $commandValidator;
    }


    /**
     * Updates an existing cron task
     *
     * @param TblCronTask $cronTask       CronTask to update
     * @param string      $name           Name for the cron task
     * @param string      $description    Description of the cron
     * @param string      $command        Command string (i.e.: "cache:clear")
     * @param string      $cronExpression Cron expression (https://en.wikipedia.org/wiki/Cron)
     * @return TblCronTask
     * @throws CommandNotExistsException
     */
    public function update(TblCronTask &$cronTask, $name, $description, $command, $cronExpression)
    {
        if (!$this->_commandValidator->commandExists($command)) {
            throw new CommandNotExistsException($command);
        }

        $cronTask
            ->setName($name)
            ->setDescription($description)
            ->setCommand($command)
            ->setCronExpression($cronExpression);

        $this->_entityManager->flush($cronTask);

        return $cronTask;
    }

    /**
     * Updates last run
     *
     * @param TblCronTask $cronTask
     * @param \DateTime   $lastRun
     */
    public function updateLastRun(TblCronTask &$cronTask, \DateTime $lastRun)
    {
        $cronTask->setLastRun($lastRun);
        $this->_entityManager->flush($cronTask);
    }

    /**
     * Updates active flag
     *
     * @param TblCronTask $cronTask
     * @param bool        $active
     */
    public function updateActive(TblCronTask &$cronTask, $active)
    {
        $cronTask->setActive($active);
        $this->_entityManager->flush($cronTask);
    }

    /**
     * Activate CronTask
     *
     * @param TblCronTask $cronTask
     */
    public function activate(TblCronTask &$cronTask)
    {
        $this->updateActive($cronTask, true);
    }

    /**
     * Deactivate CronTask
     *
     * @param TblCronTask $cronTask
     */
    public function deactivate(TblCronTask &$cronTask)
    {
        $this->updateActive($cronTask, false);
    }

}