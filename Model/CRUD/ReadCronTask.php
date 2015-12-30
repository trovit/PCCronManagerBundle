<?php


namespace Parsingcorner\CronManagerBundle\Model\CRUD;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMInvalidArgumentException;
use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Repository\TblCronTaskRepository;

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
}