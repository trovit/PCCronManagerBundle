<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Repository;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;

/**
 * TblCronTaskRepository mocks generator
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Mocks\Repository
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
     * @return \PHPUnit_Framework_MockObject_MockObject|\Parsingcorner\CronManagerBundle\Repository\TblCronTaskRepository
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Parsingcorner\\CronManagerBundle\\Repository\\TblCronTaskRepository')
            ->disableOriginalConstructor()
            ->getMock();
    }


    /**
     * @param int         $id
     * @param TblCronTask $cronTask
     * @return \Parsingcorner\CronManagerBundle\Repository\TblCronTaskRepository|\PHPUnit_Framework_MockObject_MockObject
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
     * @return \Parsingcorner\CronManagerBundle\Repository\TblCronTaskRepository|\PHPUnit_Framework_MockObject_MockObject
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