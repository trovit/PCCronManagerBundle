<?php
namespace Trovit\CronManagerBundle\Tests\Model\CRUD;

use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Model\CRUD\UpdateCronTask;
use Trovit\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Trovit\CronManagerBundle\Tests\Mocks\External\EntityManagerMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Model\CommandValidatorMocks;

/**
 * UpdateCronTaskTest
 *
 * @package Trovit\CronManagerBundle\Tests\Model\CRUD
 */
class UpdateCronTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var EntityManagerMocks
     */
    private $_entityManagerMocks;
    /**
     * @var CommandValidatorMocks
     */
    private $_commandValidatorMocks;
    /**
     * @var TblCronTaskMocks
     */
    private $_tblCronTaskMocks;

    public function setUp()
    {
        $this->_entityManagerMocks = new EntityManagerMocks($this);
        $this->_commandValidatorMocks = new CommandValidatorMocks($this);
        $this->_tblCronTaskMocks = new TblCronTaskMocks();
    }

    /**
     * Tests update method
     */
    public function testUpdateOk()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getCustomMock(
            $name = 'test',
            $description = 'test description',
            $command = 'cron:test',
            $cronExpression = '*/5 * * * *'
        );

        $cronTaskAfterUpdateMock = $this->_tblCronTaskMocks->getCustomMock(
            $newName = 'test-new',
            $newDescription = 'test description new',
            $newCommand = 'cron:test-new',
            $newCronExpression = '*/10 * * * *'
        );

        $sut = $this->getSut(
            $cronTaskAfterUpdateMock,
            $flushedNumCalls = 1,
            $commandExistsNumCalls = 1,
            $commandExists = true
        );
        $sut->update($cronTaskMock, $newName, $newDescription, $newCommand, $newCronExpression);
    }

    /**
     * Tests update method when command doesn't exists
     */
    public function testUpdateCommandDoesNotExists()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getCustomMock(
            $name = 'test',
            $description = 'test description',
            $command = 'cron:test',
            $cronExpression = '*/5 * * * *'
        );

        $cronTaskAfterUpdateMock = $this->_tblCronTaskMocks->getCustomMock(
            $newName = 'test-new',
            $newDescription = 'test description new',
            $newCommand = 'cron:test-not-exists',
            $newCronExpression = '*/10 * * * *'
        );

        $sut = $this->getSut(
            $cronTaskAfterUpdateMock,
            $flushedNumCalls = 0,
            $commandExistsNumCalls = 1,
            $commandExists = false
        );
        $this->setExpectedException('Trovit\CronManagerBundle\Exception\CommandNotExistsException');
        $sut->update($cronTaskMock, $newName, $newDescription, $newCommand, $newCronExpression);
    }

    /**
     * Tests updateLastRun method
     */
    public function testUpdateLastRun()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getCustomMock(
            $name = 'test',
            $description = 'test description',
            $command = 'cron:test',
            $cronExpression = '*/5 * * * *'
        );

        $cronTaskAfterUpdateMock = clone $cronTaskMock;
        $dateTime = new \DateTime();
        $cronTaskAfterUpdateMock->setLastRun($dateTime);

        $sut = $this->getSut(
            $cronTaskAfterUpdateMock,
            $flushedNumCalls = 1,
            $commandExistsNumCalls = 0,
            $commandExists = true
        );
        $sut->updateLastRun($cronTaskMock, $dateTime);
    }

    /**
     * @param TblCronTask $cronTask
     * @param int         $flushedNumCalls
     * @param int         $commandExistsNumCalls
     * @param bool        $commandExists
     * @return UpdateCronTask
     */
    private function getSut(TblCronTask $cronTask, $flushedNumCalls, $commandExistsNumCalls, $commandExists)
    {
        return new UpdateCronTask(
            $this->_entityManagerMocks->getUpdateCronTaskTestMock($cronTask, $flushedNumCalls),
            $this->_commandValidatorMocks->getUpdateCronTaskTestMock($commandExistsNumCalls, $commandExists)
        );
    }


}