<?php

namespace League\Bumble\Util;

use PHPUnit_Framework_TestCase;

class PcntlTest extends PHPUnit_Framework_TestCase
{

    public function testGetAllowedMethods()
    {
        $expected = [
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
        $pcntl = new Pcntl();
        $getAllowedMethods = new \ReflectionMethod(get_class($pcntl), 'getAllowedMethods');
        $getAllowedMethods->setAccessible(true);
        $this->assertEquals($expected, $getAllowedMethods->invoke($pcntl));
    }

    public function testPcntlPrefixAndNamespace()
    {
        $pcntl = new Pcntl();
        $prefix = new \ReflectionProperty(get_class($pcntl), 'prefix');
        $prefix->setAccessible(true);
        $this->assertEquals('pcntl_', $prefix->getValue($pcntl));
        $namespace = new \ReflectionProperty(get_class($pcntl), 'namespace');
        $namespace->setAccessible(true);
        $this->assertEquals('', $namespace->getValue($pcntl));
    }
}
