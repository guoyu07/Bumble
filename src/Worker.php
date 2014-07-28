<?php

namespace League\Bumble;

use Exception;
use League\Bumble\Util\Pcntl;
use League\Bumble\Util\Posix;

class Worker
{

    /** @var int */
    protected $pid;

    /** @var Pcntl */
    protected $pcntl;

    /** @var Posix */
    protected $posix;

    /** @var string */
    protected $script;

    /** @var array */
    protected $args;

    public function __construct($script, array $args, Pcntl $pcntl, Posix $posix)
    {
        $this->script = $script;
        $this->args = $args;
        $this->pcntl = $pcntl;
        $this->posix = $posix;
    }

    public function spawnProcess()
    {
        $this->pid = $this->pcntl->fork();
        if (!$this->pid) {
            $this->detachFromTerminal();
        }
    }

    public function killProcess()
    {
        $this->posix->kill($this->getPid(), SIGTERM);
        $this->pcntl->waitpid($this->getPid(), $status);
    }

    public function valid()
    {
        $this->pcntl->waitpid($this->getPid(), $status, WNOHANG);
        return (bool)$this->posix->getsid($this->getPid());
    }

    protected function detachFromTerminal()
    {
        if ($this->posix->setsid() === -1) {
            throw new Exception('Forked process could not detach from terminal!');
        }
        $this->closeResources(STDERR, STDOUT, STDIN);
        $this->pcntl->exec($this->script, array_map('escapeshellarg', $this->args));
        throw new Exception('Failed to fork ' . $this->script);
    }

    protected function closeResources($stderr, $stdout, $stdin)
    {
        fclose($stderr);
        fclose($stdout);
        fclose($stdin);
    }

    /**
     * @return int
     */
    public function getPid()
    {
        return $this->pid;
    }
}
