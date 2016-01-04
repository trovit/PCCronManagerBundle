<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\Model;

use Parsingcorner\CronManagerBundle\Tests\Mocks\External\CronExpressionMocks;

/**
 * CronExpressionWrapper mocks generator
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Mocks\Model
 */
class CronExpressionWrapperMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * CronExpressionWrapperMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Parsingcorner\CronManagerBundle\Model\CronExpressionWrapper
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Parsingcorner\\CronManagerBundle\\Model\\CronExpressionWrapper')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param $isDue
     * @return \Parsingcorner\CronManagerBundle\Model\CronExpressionWrapper|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCronDispatcherTestMock($isDue)
    {
        $mock = $this->getBasicMock();
        $cronExpressionMocks = new CronExpressionMocks($this->_testCase);
        $mock
            ->expects($this->_testCase->any())
            ->method('createCronExpression')
            ->willReturn($cronExpressionMocks->getCronDispatcherTestMock($isDue));

        return $mock;
    }
}