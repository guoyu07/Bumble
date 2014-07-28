<?php

namespace League\Bumble\Util;

/**
 * Class Pcntl
 * @package League\Bumble\Util
 *
 * @method int alarm(int $seconds) Set an alarm clock for delivery of a signal
 * @method int errno()
 * @method void exec(string $path, array $args = null, array $envs = null) Executes specified program in current process
 * space
 * @method int fork() Forks the currently running process
 * @method int get_last_error()
 * @method int|bool getpriority(int $pid, int $process_identifier = 0) Get the priority of any process
 * @method bool setpriority(int $priority, int $pid, int $process_identifier = 0) Change the priority of any process
 * @method bool signal_dispatch() Calls signal handlers for pending signals
 * @method bool signal(int $signo, callable $handler) Installs a signal handler
 * @method string strerror(int $errno)
 * @method int wexitstatus(int $status) Returns the return code of a terminated child
 * @method bool wifexited(int $status) Checks if status code represents a normal exit
 * @method bool wifsignaled(int $status) Checks whether the status code represents a termination due to a signal
 * @method bool wifstopped(int $status) Checks whether the child process is currently stopped
 * @method int wstopsig(int $status) Returns the signal which caused the child to stop
 * @method int wtermsig(int $status) Returns the signal which caused the child to terminate
 */
class Pcntl extends FunctionLibWrapper
{

    protected $prefix = 'pcntl_';

    /**
     * Sets and retrieves blocked signals
     *
     * @param int $how
     * @param array $set
     * @param array $oldSet
     * @return bool
     */
    public function sigprocmask($how, $set, &$oldSet)
    {
        return pcntl_sigprocmask($how, $set, $oldSet);
    }

    /**
     * Waits for signals, with a timeout
     *
     * @param array $set
     * @param array $sigInfo
     * @param int $seconds
     * @param int $nanoseconds
     * @return bool
     */
    public function sigtimedwait($set, &$sigInfo, $seconds = 0, $nanoseconds = 0)
    {
        return pcntl_sigprocmask($set, $sigInfo, $seconds, $nanoseconds);
    }

    /**
     * Waits for signals
     *
     * @param array $set
     * @param array $sigInfo
     * @return int
     */
    public function sigwaitinfo($set, &$sigInfo)
    {
        return pcntl_sigwaitinfo($set, $sigInfo);
    }

    /**
     * Waits on or returns the status of a forked child
     *
     * @param int $status
     * @param int $options
     * @return int
     */
    public function wait(&$status, $options = 0)
    {
        return pcntl_wait($status, $options);
    }

    /**
     * Waits on or returns the status of a forked child
     *
     * @param int $pid
     * @param int $status
     * @param int $options
     * @return int
     */
    public function waitpid($pid, &$status, $options = 0)
    {
        return pcntl_waitpid($pid, $status, $options);
    }

    /**
     * @return array An array of allowed function names
     */
    protected function getAllowedMethods()
    {
        return [
            'alarm',
            'errno',
            'exec',
            'fork',
            'get_last_error',
            'getpriority',
            'setpriority',
            'signal_dispatch',
            'signal',
            'sigprocmask',
            'sigtimedwait',
            'sigwaitinfo',
            'strerror',
            'wait',
            'waitpid',
            'wexitstatus',
            'wifexited',
            'wifsignaled',
            'wifstopped',
            'wstopsig',
            'wtermsig',
        ];
    }
}
