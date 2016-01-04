<?php
namespace Parsingcorner\CronManagerBundle\Model\CRUD;

use Doctrine\ORM\EntityManager;
use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Exception\CommandNotExistsException;
use Parsingcorner\CronManagerBundle\Model\CommandValidator;

/**
 * Model to create new cron tasks
 *
 * @package Parsingcorner\CronManagerBundle\Model\CRUD
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
        if (!$this->_commandValidator->commandExists($command)) {
            throw new CommandNotExistsException($command);
        }

        $cronTask = new TblCronTask();
        $cronTask
            ->setName($name)
            ->setDescription($description)
            ->setCommand($command)
            ->setCronExpression($cronExpression);

        $this->_entityManager->persist($cronTask);
        $this->_entityManager->flush($cronTask);

        return $cronTask;
    }
}