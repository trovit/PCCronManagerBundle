<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Model;

/**
 * CommandValidator mocks generator
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Mocks\Model
 */
class CommandValidatorMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CommandValidatorMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Parsingcorner\CronManagerBundle\Model\CommandValidator
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Parsingcorner\\CronManagerBundle\\Model\\CommandValidator')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param bool $commandExistsReturn
     * @return \Parsingcorner\CronManagerBundle\Model\CommandValidator|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCreateCronTaskTestMock($commandExistsReturn)
    {
        $mock = $this->getBasicMock();
        $mock->expects($this->_testCase->once())
            ->method('commandExists')
            ->willReturn($commandExistsReturn);

        return $mock;
    }

    /**
     * @param int  $commandExistsNumCalls
     * @param bool $commandExistsReturn
     * @return \Parsingcorner\CronManagerBundle\Model\CommandValidator|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getUpdateCronTaskTestMock($commandExistsNumCalls, $commandExistsReturn)
    {
        $mock = $this->getBasicMock();
        $mock->expects($this->_testCase->exactly($commandExistsNumCalls))
            ->method('commandExists')
            ->willReturn($commandExistsReturn);

        return $mock;
    }
}