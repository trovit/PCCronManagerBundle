<?php
namespace Parsingcorner\CronManagerBundle\Tests\Model\CRUD;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\ReadCronTask;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\External\EntityManagerMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Repository\TblCronTaskRepositoryMocks;

/**
 * ReadCronTaskTest
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Model\CRUD
 */
class ReadCronTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManagerMocks
     */
    private $_entityManagerMocks;
    /**
     * @var TblCronTaskRepositoryMocks
     */
    private $_tblCronTaskRepositoryMocks;
    /**
     * @var TblCronTaskMocks
     */
    private $_tblCronTaskMocks;

    public function setUp()
    {
        $this->_entityManagerMocks = new EntityManagerMocks($this);
        $this->_tblCronTaskRepositoryMocks = new TblCronTaskRepositoryMocks($this);
        $this->_tblCronTaskMocks = new TblCronTaskMocks();
    }

    /**
     * Tests delete method
     */
    public function testRead()
    {
        $cronTasks = array($this->_tblCronTaskMocks->getBasicMock(), $this->_tblCronTaskMocks->getBasicMock());
        $sut = $this->_getSut($cronTasks);

        $this->assertEquals($cronTasks, $sut->getAllCronTasks());
        $this->assertEquals($cronTasks, $sut->getActiveCronTasks());
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @return ReadCronTask
     */
    private function _getSut(array $cronTasks)
    {
        return new ReadCronTask($this->_tblCronTaskRepositoryMocks->getReadMock($cronTasks));
    }

}