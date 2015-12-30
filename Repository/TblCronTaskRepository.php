<?php

namespace Parsingcorner\CronManagerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Parsingcorner\CronManagerBundle\Entity\TblCronTask;

/**
 * TblCronTaskRepository
 *
 */
class TblCronTaskRepository extends EntityRepository
{
    /**
     * Obtain active cron tasks
     *
     * @return TblCronTask[]
     */
    public function getActiveCronTasks()
    {
        $this->clear();
        return $this->findBy(array(
            'active' => true
        ));
    }
}
