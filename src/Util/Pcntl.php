<?php

namespace League\Bumble\Util;

/**
 * Class Pcntl
 * @package League\Bumble\Util
 *
 * @method int alarm(int $seconds) Set an alarm clock for delivery of a signal
 * @method int errno()
 * @method void exec(string $path, array $args = null, array $envs = null) Executes specified program in current process space
 * @method int fork() Forks the currently running process
 * @method int get_last_error()
 * @method int|bool getpriority(int $pid, int $process_identifier = 0) Get the priority of any process
 * @method bool setpriority(int $priority, int $pid, int $process_identifier = 0) Change the priority of any process
 * @method bool signal_dispatch() Calls signal handlers for pending signals
 * @method bool signal(int $signo, callable $handler) Installs a signal handler
 * @method bool sigprocmask(int $how, array $set, array &$oldset = null) Sets and retrieves blocked signals
 * @method int sigtimedwait(array $set, array &$siginfo = null, $seconds = 0, $nanoseconds = 0) Waits for signals, with a timeout
 * @method int sigwaitinfo(array $set, array &$siginfo = null) Waits for signals
 * @method string strerror(int $errno)
 * @method int wait(int &$status, int $options = 0) Waits on or returns the status of a forked child
 * @method int waitpid(int $pid, int &$status, int $options = 0) Waits on or returns the status of a forked child
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
