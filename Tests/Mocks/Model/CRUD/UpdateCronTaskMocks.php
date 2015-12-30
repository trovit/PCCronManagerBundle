<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CRUD;

/**
 * UpdateCronTask mocks generator
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CRUD
 */
class UpdateCronTaskMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * UpdateCronTaskMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Parsingcorner\CronManagerBundle\Model\CRUD\UpdateCronTask
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Parsingcorner\\CronManagerBundle\\Model\\CRUD\\UpdateCronTask')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param int $updateLastRunNumCalls
     * @return \Parsingcorner\CronManagerBundle\Model\CRUD\UpdateCronTask|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCronDispatcherTestMock($updateLastRunNumCalls)
    {
        $mock = $this->getBasicMock();
        $mock
            ->expects($this->_testCase->exactly($updateLastRunNumCalls))
            ->method('updateLastRun');

        return $mock;
    }
}