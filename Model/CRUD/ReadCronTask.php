<?php
namespace Trovit\CronManagerBundle\Model\CRUD;

use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Repository\TblCronTaskRepository;

/**
 * Model to retrieve existing cron tasks
 *
 * @package Trovit\CronManagerBundle\Model\CRUD
 */
class ReadCronTask
{
    /**
     * @var TblCronTaskRepository
     */
    private $_cronTaskRepository;

    /**
     * DeleteCronTask constructor.
     *
     * @param TblCronTaskRepository $cronTaskRepository
     */
    public function __construct(TblCronTaskRepository $cronTaskRepository)
    {
        $this->_cronTaskRepository = $cronTaskRepository;
    }


    /**
     * @return TblCronTask[]
     */
    public function getAllCronTasks()
    {
        return $this->_cronTaskRepository->findAll();
    }

    /**
     * @return TblCronTask[]
     */
    public function getActiveCronTasks()
    {
        return $this->_cronTaskRepository->getActiveCronTasks();
    }

    /**
     * @param int $id
     * @return null|object
     */
    public function getCronById($id)
    {
        return $this->_cronTaskRepository->find($id);
    }
}