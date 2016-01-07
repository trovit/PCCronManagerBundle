<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Model;

/**
 * CommandExecute mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Model
 */
class CommandExecuteMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CommandExecuteMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Model\CommandExecute
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Model\\CommandExecute')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function getCronDispatcherTestMock($executeBackgroundCommandNumCalls)
    {
        $mock = $this->getBasicMock();
        $mock
            ->expects($this->_testCase->exactly($executeBackgroundCommandNumCalls))
            ->method('executeBackgroundCommand');

        return $mock;
    }
}