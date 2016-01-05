<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Model;

/**
 * CronDispatcher mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Model
 */
class CronDispatcherMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CronDispatcherMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Model\CronDispatcher
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Model\\CronDispatcher')
            ->disableOriginalConstructor()
            ->getMock();
    }
}