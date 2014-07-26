<?php

namespace League\Bumble\Util;

class Posix extends FunctionLibWrapper
{

    protected $prefix = 'posix_';

    /**
     * @return array An array of allowed function names
     */
    protected function getAllowedMethods()
    {
        return [
            'access',
            'ctermid',
            'errno',
            'get_last_error',
            'getcwd',
            'getegid',
            'geteuid',
            'getgid',
            'getgrgid',
            'getgrnam',
            'getgroups',
            'getlogin',
            'getpgid',
            'getpgrp',
            'getpid',
            'getppid',
            'getpwnam',
            'getpwuid',
            'getrlimit',
            'getsid',
            'getuid',
            'initgroups',
            'isatty',
            'kill',
            'mkfifo',
            'mknod',
            'setegid',
            'seteuid',
            'setgid',
            'setpgid',
            'setsid',
            'setuid',
            'strerror',
            'times',
            'ttyname',
            'uname',
        ];
    }
}
