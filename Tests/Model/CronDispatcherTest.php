<?php
namespace Trovit\CronManagerBundle\Tests\Model;

use Trovit\CronManagerBundle\Entity\TblCronTask;
use Trovit\CronManagerBundle\Model\CronDispatcher;
use Trovit\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Model\CommandExecuteMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Model\CronExpressionWrapperMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD\ReadCronTaskMocks;
use Trovit\CronManagerBundle\Tests\Mocks\Model\CRUD\UpdateCronTaskMocks;

/**
 * CronDispatcherTest
 *
 * @package Trovit\CronManagerBundle\Tests\Model
 */
class CronDispatcherTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ReadCronTaskMocks
     */
    private $_readCronTaskMocks;
    /**
     * @var UpdateCronTaskMocks
     */
    private $_updateCronTaskMocks;
    /**
     * @var CommandExecuteMocks
     */
    private $_commandExecuteMocks;
    /**
     * @var TblCronTaskMocks
     */
    private $_tblCronTaskMocks;
    /**
     * @var CronExpressionWrapperMocks
     */
    private $_cronExpressionWrapperMocks;

    public function setUp()
    {
        $this->_readCronTaskMocks = new ReadCronTaskMocks($this);
        $this->_updateCronTaskMocks = new UpdateCronTaskMocks($this);
        $this->_commandExecuteMocks = new CommandExecuteMocks($this);
        $this->_tblCronTaskMocks = new TblCronTaskMocks();
        $this->_cronExpressionWrapperMocks = new CronExpressionWrapperMocks($this);
    }

    /**
     * Tests executeCrons method
     */
    public function testExecuteCronsOk1()
    {
        $cronTasks = array(
            $this->_tblCronTaskMocks->getCustomMock(
                'test-command',
                'Test command',
                'cron:test-command',
                '*/10 * * * *',
                new \DateTime('01/01/2016 09:50:00')
            )
        );

        $sut = $this->_getSut(
            $cronTasks,
            $executeBackgroundCommandNumCalls = 1,
            true
        );

        $sut->executeCrons(false);
    }

    /**
     * Tests executeCrons method
     */
    public function testExecuteCronsNoDue()
    {
        $cronTasks = array(
            $this->_tblCronTaskMocks->getCustomMock(
                'test-command',
                'Test command',
                'cron:test-command',
                '*/10 * * * *',
                new \DateTime('01/01/2016 09:50:00')
            )
        );

        $sut = $this->_getSut(
            $cronTasks,
            $executeBackgroundCommandNumCalls = 0,
            false
        );

        $sut->executeCrons(false);
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @param int           $executeBackgroundCommandNumCalls
     * @param bool          $isDue
     * @return CronDispatcher
     */
    private function _getSut(
        array $cronTasks,
        $executeBackgroundCommandNumCalls,
        $isDue
    ) {
        return new CronDispatcher(
            $this->_readCronTaskMocks->getCronDispatcherTestMock($cronTasks),
            $this->_updateCronTaskMocks->getCronDispatcherTestMock($executeBackgroundCommandNumCalls),
            $this->_commandExecuteMocks->getCronDispatcherTestMock($executeBackgroundCommandNumCalls),
            $this->_cronExpressionWrapperMocks->getCronDispatcherTestMock($isDue),
            1
        );
    }
}