<?php
namespace Trovit\CronManagerBundle\Model;

use Cron\CronExpression;
use Cron\FieldFactory;

class CronExpressionWrapper
{

    /**
     * Factory method to create a new CronExpression.
     *
     * @param string $expression The CRON expression to create.  There are
     *                           several special predefined values which can be used to substitute the
     *                           CRON expression:
     *
     *      `@yearly`, `@annually` - Run once a year, midnight, Jan. 1 - 0 0 1 1 *
     *      `@monthly` - Run once a month, midnight, first of month - 0 0 1 * *
     *      `@weekly` - Run once a week, midnight on Sun - 0 0 * * 0
     *      `@daily` - Run once a day, midnight - 0 0 * * *
     *      `@hourly` - Run once an hour, first minute - 0 * * * *
     * @param FieldFactory $fieldFactory Field factory to use
     *
     * @return CronExpression
     */
    public function createCronExpression($expression, FieldFactory $fieldFactory = null)
    {
        return CronExpression::factory($expression, $fieldFactory);
    }

}
