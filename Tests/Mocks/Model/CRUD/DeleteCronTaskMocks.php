<?php
namespace Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD;

/**
 * DeleteCronTask mocks generator
 *
 * @package Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD
 */
class DeleteCronTaskMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * DeleteCronTaskMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Trovit\CronManagerBundle\Model\CRUD\DeleteCronTask
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Trovit\\CronManagerBundle\\Model\\CRUD\\DeleteCronTask')
            ->disableOriginalConstructor()
            ->getMock();
    }
}