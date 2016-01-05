<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\External;

use Trovit\CronManagerBundle\Entity\TblCronTask;

/**
 * CronExpression mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\External
 */
class CronExpressionMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CronExpressionMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Cron\CronExpression
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Cron\\CronExpression')
            ->disableOriginalConstructor()
            ->getMock();
    }


    /**
     * @param bool $isDue
     * @return \Cron\CronExpression|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCronDispatcherTestMock($isDue)
    {
        $mock = $this->getBasicMock();

        $mock->expects($this->_testCase->any())
            ->method('isDue')
            ->willReturn($isDue);

        return $mock;
    }
}