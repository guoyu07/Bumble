<?php

namespace League\Bumble\Util;

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
