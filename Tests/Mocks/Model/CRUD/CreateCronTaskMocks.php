<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD;

/**
 * CreateCronTask mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD
 */
class CreateCronTaskMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CreateCronTaskMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Model\CRUD\CreateCronTask
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Model\\CRUD\\CreateCronTask')
            ->disableOriginalConstructor()
            ->getMock();
    }
}