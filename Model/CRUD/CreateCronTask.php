<?php
namespace Trovit\CronManagerBundle\Model\CRUD;

use Doctrine\ORM\EntityManager;
use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Exception\CommandNotExistsException;
use Trovit\CronManagerBundle\Model\CommandValidator;

/**
 * Model to create new cron tasks
 *
 * @package Trovit\CronManagerBundle\Model\CRUD
 */
class CreateCronTask
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
     * CreateCronTask constructor.
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
     * Creates a new cron task
     *
     * @param string $name           Name for the cron task
     * @param string $description    Description of the cron
     * @param string $command        Command string (i.e.: "cache:clear")
     * @param string $cronExpression Cron expression (https://en.wikipedia.org/wiki/Cron)
     * @return TblCronTask
     * @throws CommandNotExistsException
     */
    public function create($name, $description, $command, $cronExpression)
    {
        $cronTask = new TblCronTask();
        $cronTask
            ->setName($name)
            ->setDescription($description)
            ->setCommand($command)
            ->setCronExpression($cronExpression);

        return $this->persistCron($cronTask);
    }


    /**
     * Creates a new cron task
     *
     * @param TblCronTask $cronTask
     * @return TblCronTask
     * @throws CommandNotExistsException
     */
    public function persistCron(TblCronTask $cronTask)
    {
        if (!$this->_commandValidator->commandExists($cronTask->getCommand())) {
            throw new CommandNotExistsException($cronTask->getCommand());
        }

        $this->_entityManager->persist($cronTask);
        $this->_entityManager->flush($cronTask);

        return $cronTask;
    }
}