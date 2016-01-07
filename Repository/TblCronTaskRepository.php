<?php

namespace Trovit\CronManagerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Trovit\CronManagerBundle\Entity\TblCronTask;

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
