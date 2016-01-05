<?php

namespace Trovit\CronManagerBundle\Entity;

/**
 * TblCronTask entity
 */
class TblCronTask
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $command;
    /**
     * @var \DateTime
     */
    private $lastRun;

    /**
     * @var string
     */
    private $cronExpression;

    /**
     * @var boolean
     */
    private $active = true;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return TblCronTask
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return TblCronTask
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set command
     *
     * @param string $command
     *
     * @return TblCronTask
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set lastRun
     *
     * @param \DateTime $lastRun
     *
     * @return TblCronTask
     */
    public function setLastRun($lastRun)
    {
        $this->lastRun = $lastRun;

        return $this;
    }

    /**
     * Get lastRun
     *
     * @return \DateTime
     */
    public function getLastRun()
    {
        return $this->lastRun;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return TblCronTask
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }
    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getCronExpression()
    {
        return $this->cronExpression;
    }

    /**
     * @param string $cronExpression
     * @return $this
     */
    public function setCronExpression($cronExpression)
    {
        $this->cronExpression = $cronExpression;

        return $this;
    }

}
