<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CRUD;


use Parsingcorner\CronManagerBundle\Entity\TblCronTask;

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
     * @return \PHPUnit_Framework_MockObject_MockObject|\Parsingcorner\CronManagerBundle\Model\CRUD\ReadCronTask
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Parsingcorner\\CronManagerBundle\\Model\\CRUD\\ReadCronTask')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @return \Parsingcorner\CronManagerBundle\Model\CRUD\ReadCronTask|\PHPUnit_Framework_MockObject_MockObject
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