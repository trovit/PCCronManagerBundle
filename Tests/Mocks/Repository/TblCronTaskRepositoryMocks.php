<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Repository;

use Trovit\CronManagerBundle\Entity\TblCronTask;

/**
 * TblCronTaskRepository mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Repository
 */
class TblCronTaskRepositoryMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * TblCronTaskRepositoryMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Repository\TblCronTaskRepository
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Repository\\TblCronTaskRepository')
            ->disableOriginalConstructor()
            ->getMock();
    }


    /**
     * @param int         $id
     * @param TblCronTask $cronTask
     * @return \Trovit\CronManagerBundle\Repository\TblCronTaskRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getDeleteByIdCronTaskTestMock($id, TblCronTask $cronTask = null)
    {
        $mock = $this->getBasicMock();
        $mock->expects($this->_testCase->once())
            ->method('find')
            ->with($id)
            ->willReturn($cronTask);

        return $mock;
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @return \Trovit\CronManagerBundle\Repository\TblCronTaskRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getReadMock(array $cronTasks)
    {
        $mock = $this->getBasicMock();
        $mock->expects($this->_testCase->once())
            ->method('findAll')
            ->willReturn($cronTasks);

        $mock->expects($this->_testCase->once())
            ->method('getActiveCronTasks')
            ->willReturn($cronTasks);

        return $mock;
    }
}