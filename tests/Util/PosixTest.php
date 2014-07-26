<?php

namespace League\Bumble\Util;

use PHPUnit_Framework_TestCase;

class PosixTest extends PHPUnit_Framework_TestCase
{

    public function testGetAllowedMethods()
    {
        $expected = [
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
        $posix = new Posix();
        $getAllowedMethods = new \ReflectionMethod(__NAMESPACE__ . '\Posix', 'getAllowedMethods');
        $getAllowedMethods->setAccessible(true);
        $this->assertEquals($expected, $getAllowedMethods->invoke($posix));
    }

    public function testPosixPrefixAndNamespace()
    {
        $posix = new Posix();
        $prefix = new \ReflectionProperty(get_class($posix), 'prefix');
        $prefix->setAccessible(true);
        $this->assertEquals('posix_', $prefix->getValue($posix));
        $namespace = new \ReflectionProperty(get_class($posix), 'namespace');
        $namespace->setAccessible(true);
        $this->assertEquals('', $namespace->getValue($posix));
    }
}
