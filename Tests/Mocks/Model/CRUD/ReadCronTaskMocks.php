<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD;

use Trovit\CronManagerBundle\Entity\TblCronTask;

/**
 * ReadCronTask mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD
 */
class ReadCronTaskMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * ReadCronTaskMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Model\CRUD\ReadCronTask
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Model\\CRUD\\ReadCronTask')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @return \Trovit\CronManagerBundle\Model\CRUD\ReadCronTask|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCronDispatcherTestMock(array $cronTasks)
    {
        $mock = $this->getBasicMock();

        $mock->expects($this->_testCase->once())
            ->method('getActiveCronTasks')
            ->willReturn($cronTasks);

        return $mock;
    }
}