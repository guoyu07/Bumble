<?php

namespace League\Bumble\Util;

/**
 * Class Posix
 * @package League\Bumble\Util
 *
 * @method bool access(string $file, int $mode = 0) Determine accessibility of a file
 * @method string|bool ctermid() Get path name of controlling terminal
 * @method int errno() Alias of <b>posix_get_last_error</b>
 * @method int get_last_error() Retrieve the error number set by the last posix function that failed
 * @method string|bool getcwd() Pathname of current directory
 * @method int getegid() Return the effective group ID of the current process
 * @method int geteuid() Return the effective user ID of the current process
 * @method int getgid() Return the real group ID of the current process
 * @method array getgrgid(int $gid) Return info about a group by group id
 * @method array getgrnam(string $name) Return info about a group by name
 * @method array getgroups() Return the group set of the current process
 * @method string getlogin() Return login name
 * @method int getpgid(int $gid) Get process group id for job control
 * @method int getpgrp() Return the current process group identifier
 * @method int getpid() Return the current process identifier
 * @method int getppid() Return the parent process identifier
 * @method array getpwnam(string $username) Return info about a user by username
 * @method array getpwuid(int $uid) Return info about a user by user id
 * @method array getrlimit() Return info about system resource limits
 * @method int getsid(int $pid) Get the current sid of the process
 * @method int getuid() Return the real user ID of the current process
 * @method bool initgroups(string $name, int $base_group_id) Calculate the group access list
 * @method bool isatty(int $fd) Determine if a file descriptor is an interactive terminal
 * @method bool kill(int $pid, int $sig) Send a signal to a process
 * @method bool mkfifo(string $pathname, int $mode) Create a fifo special file (a named pipe)
 * @method bool mknod(string $pathname, int $mode, int $major = 0, int $minor = 0) Create a special or ordinary file
 * (POSIX.1)
 * @method bool setegid(int $gid) Set the effective GID of the current process
 * @method bool seteuid(int $uid) Set the effective UID of the current process
 * @method bool setgid(int $gid) Set the GID of the current process
 * @method bool setpgid(int $pid, int $pgid) Set process group id for job control
 * @method int setsid() Make the current process a session leader
 * @method bool setuid(int $uid) Set the UID of the current process
 * @method string strerror(int $errno) Retrieve the system error message associated with the given errno
 * @method array times() Get process times
 * @method string|bool ttyname(int $fd) Determine terminal device name
 * @method array uname() Get system name
 */
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
