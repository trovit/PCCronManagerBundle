<?php
namespace Trovit\CronManagerBundle\Model\CRUD;

use Doctrine\ORM\EntityManager;
use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Exception\CronTaskNotExistsException;
use Trovit\CronManagerBundle\Repository\TblCronTaskRepository;

/**
 * Model to delete cron tasks
 *
 * @package Trovit\CronManagerBundle\Model\CRUD
 */
class DeleteCronTask
{
    /**
     * @var TblCronTaskRepository
     */
    private $_cronTaskRepository;
    /**
     * @var EntityManager
     */
    private $_entityManager;

    /**
     * DeleteCronTask constructor.
     *
     * @param TblCronTaskRepository $cronTaskRepository
     * @param EntityManager         $entityManager
     */
    public function __construct(TblCronTaskRepository $cronTaskRepository, EntityManager $entityManager)
    {
        $this->_cronTaskRepository = $cronTaskRepository;
        $this->_entityManager = $entityManager;
    }


    /**
     * Deletes a cron task by id
     *
     * @param $id
     * @throws CronTaskNotExistsException
     */
    public function deleteById($id)
    {
        $cronTask = $this->_cronTaskRepository->find($id);
        if ($cronTask === null) {
            throw new CronTaskNotExistsException($id);
        }
        $this->_entityManager->remove($cronTask);
    }

    /**
     * Deletes a cron task
     *
     * @param TblCronTask $cronTask
     */
    public function delete(TblCronTask $cronTask)
    {
        $this->_entityManager->remove($cronTask);
    }
}