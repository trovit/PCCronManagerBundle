<?php
namespace Parsingcorner\CronManagerBundle\Tests\Model;

use Parsingcorner\CronManagerBundle\Entity\TblCronTask;
use Parsingcorner\CronManagerBundle\Model\CronDispatcher;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Entity\TblCronTaskMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CommandExecuteMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CRUD\ReadCronTaskMocks;
use Parsingcorner\CronManagerBundle\Tests\Mocks\Model\CRUD\UpdateCronTaskMocks;

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

    public function setUp()
    {
        $this->_readCronTaskMocks = new ReadCronTaskMocks($this);
        $this->_updateCronTaskMocks = new UpdateCronTaskMocks($this);
        $this->_commandExecuteMocks = new CommandExecuteMocks($this);
        $this->_tblCronTaskMocks = new TblCronTaskMocks();
    }

    /**
     * Tests executeCrons method
     */
    public function testExecuteCrons()
    {
        $cronTasks = array(
            $this->_tblCronTaskMocks->getCustomMock(
                'test-command',
                'Test command',
                'cron:test-command',
                'PT10M',
                new \DateTime('11 minutes ago')
            ),
            $this->_tblCronTaskMocks->getCustomMock(
                'test-command',
                'Test command',
                'cron:test-command',
                'PT10M',
                null
            ),
            $this->_tblCronTaskMocks->getCustomMock(
                'test-command',
                'Test command',
                'cron:test-command',
                'PT10M',
                new \DateTime('5 minutes ago')
            )
        );

        $sut = $this->_getSut($cronTasks, $executeBackgroundCommandNumCalls = 2);

        $sut->executeCrons(false);
    }

    /**
     * @param TblCronTask[] $cronTasks
     * @param int           $executeBackgroundCommandNumCalls
     * @return CronDispatcher
     */
    private function _getSut(array $cronTasks, $executeBackgroundCommandNumCalls)
    {
        return new CronDispatcher(
            $this->_readCronTaskMocks->getCronDispatcherTestMock($cronTasks),
            $this->_updateCronTaskMocks->getCronDispatcherTestMock($executeBackgroundCommandNumCalls),
            $this->_commandExecuteMocks->getCronDispatcherTestMock($executeBackgroundCommandNumCalls),
            1
        );
    }
}