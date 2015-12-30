<?php
namespace Parsingcorner\CronManagerBundle\Tests\Model\CRUD;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Model\CRUD\CreateCronTask;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\External\EntityManagerMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CommandValidatorMocks;

/**
 * CreateCronTaskTest
 *
 * @package Parsingcorner\CronManagerBundle\Tests\Model\CRUD
 */
class CreateCronTaskTest extends \PHPUnit_Framework_TestCase
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

    public function testCreateOk()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getCustomMock(
            $name = 'test',
            $description = 'test description',
            $command = 'cron:test',
            $interval = 'PT5M'
        );
        $sut = $this->getSut($cronTaskMock, $persistedAndFlushedNumCalls = 1, $commandExists = true);
        $sut->create($name, $description, $command, $interval);
    }

    public function testCreateCommandDoesntExists()
    {
        $cronTaskMock = $this->_tblCronTaskMocks->getCustomMock(
            $name = 'test',
            $description = 'test description',
            $command = 'cron:test',
            $interval = 'PT5M'
        );
        $sut = $this->getSut($cronTaskMock, $persistedAndFlushedNumCalls = 0, $commandExists =  false);
        $this->setExpectedException('Parsingcorner\CronManagerBundle\Exception\CommandNotExistsException');
        $sut->create($name, $description, $command, $interval);
    }

    private function getSut(TblCronTask $cronTask, $persistedAndFlushedNumCalls, $commandExists)
    {
        return new CreateCronTask(
            $this->_entityManagerMocks->getCreateCronTaskTestMock($cronTask, $persistedAndFlushedNumCalls),
            $this->_commandValidatorMocks->getCreateCronTaskTestMock($commandExists)
        );
    }


}