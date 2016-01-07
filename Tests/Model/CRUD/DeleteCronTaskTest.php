<?php
namespace Trovit\CronManagerBundle\Tests\Model\CRUD;

use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Model\CRUD\DeleteCronTask;
use Trovit\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Trovit\CronManagerBundle\Tests\Mocks\External\EntityManagerMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Repository\TblCronTaskRepositoryMocks;

/**
 * DeleteCronTaskTest
 *
 * @package Trovit\CronManagerBundle\Tests\Model\CRUD
 */
class DeleteCronTaskTest extends \PHPUnit_Framework_TestCase
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
    public function testDeleteOk()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getBasicMock();
        $sut = $this->_getSut($cronTaskMock);
        $sut->delete($cronTaskMock);
    }

    /**
     * Tests deleteById method
     */
    public function testDeleteByIdOk()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getBasicMock();
        $sut = $this->_getSutDeleteById($id = 3, $cronTaskMock, 1);
        $sut->deleteById($id);
    }

    /**
     * Tests deleteById method when cron task with the specified id doesn't exists
     */
    public function testDeleteByIdDoesNotExists()
    {
        $sut = $this->_getSutDeleteById($id = 3, null, 0);
        $this->setExpectedException('Trovit\CronManagerBundle\Exception\CronTaskNotExistsException');
        $sut->deleteById($id);
    }

    /**
     * @param TblCronTask $cronTask
     * @return DeleteCronTask
     */
    private function _getSut(TblCronTask $cronTask)
    {
        return new DeleteCronTask(
            $this->_tblCronTaskRepositoryMocks->getBasicMock(),
            $this->_entityManagerMocks->getDeleteCronTaskTestMock(1, $cronTask)
        );
    }

    /**
     * @param int         $id
     * @param TblCronTask $cronTask
     * @param int         $removeNumCalls
     * @return DeleteCronTask
     */
    private function _getSutDeleteById($id, TblCronTask $cronTask = null, $removeNumCalls)
    {
        return new DeleteCronTask(
            $this->_tblCronTaskRepositoryMocks->getDeleteByIdCronTaskTestMock($id, $cronTask),
            $this->_entityManagerMocks->getDeleteCronTaskTestMock($removeNumCalls, $cronTask)
        );
    }


}