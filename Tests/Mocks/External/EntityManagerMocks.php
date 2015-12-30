<?php
namespace Parsingcorner\CronManagerBundle\Tests\Mocks\External;


use Parsingcorner\CronManagerBundle\Entity\TblCronTask;

class EntityManagerMocks
{
    /**
     * @var \PHPUnit_Framework_TestCase
     */
    private $_testCase;

    /**
     * EntityManagerMocks constructor.
     *
     * @param \PHPUnit_Framework_TestCase $testCase
     */
    public function __construct(\PHPUnit_Framework_TestCase $testCase)
    {
        $this->_testCase = $testCase;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Doctrine\ORM\EntityManager
     */
    public function getBasicMock()
    {
        return $this->_testCase->getMockBuilder('Doctrine\\ORM\\EntityManager')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @param TblCronTask $cronTask
     * @param int         $persistedAndFlushedNumCalls
     * @return \Doctrine\ORM\EntityManager|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getCreateCronTaskTestMock(TblCronTask $cronTask, $persistedAndFlushedNumCalls)
    {
        $mock = $this->getBasicMock();
        $mock->expects($this->_testCase->exactly($persistedAndFlushedNumCalls))
            ->method('persist')
            ->with($cronTask);

        $mock->expects($this->_testCase->exactly($persistedAndFlushedNumCalls))
            ->method('flush')
            ->with($cronTask);

        return $mock;
    }

    /**
     * @param TblCronTask $cronTask
     * @param int         $flushedNumCalls
     * @return \Doctrine\ORM\EntityManager|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getUpdateCronTaskTestMock(TblCronTask $cronTask, $flushedNumCalls)
    {
        $mock = $this->getBasicMock();

        $mock->expects($this->_testCase->exactly($flushedNumCalls))
            ->method('flush')
            ->with($cronTask);

        return $mock;
    }

    /**
     * @param int         $removeNumCalls
     * @param TblCronTask $cronTask
     * @return \Doctrine\ORM\EntityManager|\PHPUnit_Framework_MockObject_MockObject
     */
    public function getDeleteCronTaskTestMock($removeNumCalls, TblCronTask $cronTask = null)
    {
        $mock = $this->getBasicMock();

        $mock->expects($this->_testCase->exactly($removeNumCalls))
            ->method('remove')
            ->with($cronTask);

        return $mock;
    }
}