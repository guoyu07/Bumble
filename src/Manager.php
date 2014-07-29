<?php

namespace League\Bumble;

use League\Bumble\Util\Pcntl;
use League\Bumble\Util\Posix;

class Manager
{

    /** @var Pcntl */
    protected $pcntl;

    /** @var Posix */
    protected $posix;

    /** @var int */
    protected $maxWorkers;

    /** @var string */
    protected $script;

    /** @var array */
    protected $args;

    /** @var int */
    protected $maxRuns;

    protected $run = true;
    protected $reload = false;

    /** @var array */
    protected $workers = [];

    public function __construct(Pcntl $pcntl = null, Posix $posix = null)
    {
        $this->pcntl = $pcntl ? : new Pcntl();
        $this->posix = $posix ? : new Posix();
    }

    public function run($count, $script, array $args = [], $maxRuns = -1)
    {
        $this->maxWorkers = $count;
        $this->script = $script;
        $this->args = $args;
        $this->maxRuns = $maxRuns;

        set_time_limit(0);
        $this->mainLoop();
    }

    public function end()
    {
        $this->run = false;
    }

    public function restart()
    {
        $this->reload = true;
    }

    /**
     * Spawn a specified number of workers to run a script
     */
    protected function spawnWorkers()
    {
        if (!empty($this->workers)) {
            $this->killWorkers();
        }
        for ($counter = 0; $counter < $this->maxWorkers; $counter += 1) {
            $this->spawnWorker();
        }
    }

    protected function spawnWorker()
    {
        $worker = new Worker($this->script, $this->args, $this->pcntl, $this->posix);
        try {
            $worker->spawnProcess();
            $this->workers[] = $worker;
        } catch (\Exception $e) {
            // Do nothing
        }
    }

    protected function killWorkers(array $workers = null)
    {
        $workersToKill = $workers ? : $this->workers;
        array_walk($workersToKill, function (Worker $worker) {
            $worker->killProcess();
        });
        if (!$workers) {
            $this->workers = [];
        }
    }

    protected function checkWorkers()
    {
        $this->workers = array_filter($this->workers, function (Worker $worker) {
            return $worker->valid();
        });
        if (count($this->workers) < $this->maxWorkers) {
            do {
                $this->spawnWorker();
            } while (count($this->workers) < $this->maxWorkers);
        } elseif (count($this->workers) > $this->maxWorkers) {
            $this->killWorkers(array_slice($this->workers, $this->maxWorkers));
            $this->workers = array_slice($this->workers, 0, $this->maxWorkers);
        }
    }

    protected function mainLoop()
    {
        declare(ticks = 100);
        $this->pcntl->signal(SIGTERM, [$this, 'end']);
        $this->pcntl->signal(SIGINT, [$this, 'end']);
        $this->pcntl->signal(SIGHUP, [$this, 'restart']);
        $this->spawnWorkers();
        while ($this->pcntl->signal_dispatch() && $this->run && $this->maxRuns--) {
            if ($this->reload) {
                $this->doReload();
            } else {
                $this->checkWorkers();
            }
            usleep(150000);
        }
        $this->killWorkers();
        $this->pcntl->wait($status);
    }

    protected function doReload()
    {
        $this->reload = false;
        $this->killWorkers();
        $this->spawnWorkers();
    }
}
