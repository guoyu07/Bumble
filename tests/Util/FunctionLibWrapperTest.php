<?php

namespace League\Bumble\Util;

use PHPUnit_Framework_TestCase;

class FunctionLibWrapperTest extends PHPUnit_Framework_TestCase
{

    public function testMagicCallMethod()
    {
        $wrapper = $this->getMockWrapper(['getAllowedMethods']);
        $wrapper->expects($this->atLeastOnce())
            ->method('getAllowedMethods')
            ->will($this->returnValue(['sprintf', 'vsprintf']));
        $pattern = '%s %s!';
        $this->assertEquals('Hello World!', $wrapper->sprintf($pattern, 'Hello', 'World'));
        $this->assertEquals('Hallo Welt!', $wrapper->vsprintf($pattern, ['Hallo', 'Welt']));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Function printf not allowed!
     */
    public function testExceptionForNonAllowedMethod()
    {
        $wrapper = $this->getMockWrapper(['getAllowedMethods']);
        $wrapper->expects($this->atLeastOnce())
            ->method('getAllowedMethods')
            ->will($this->returnValue(['sprintf', 'vsprintf']));
        $wrapper->printf('%s %s!', 'Hello', 'World');
    }

    public function testPrefixedNamespacedFunctions()
    {
        $namespace = 'League\Bumble\Test' . time();
        $prefix = 'myfunc_';
        $wrapper = $this->getMockWrapper(['getAllowedMethods']);
        $nsProperty = new \ReflectionProperty(get_class($wrapper), 'namespace');
        $nsProperty->setAccessible(true);
        $nsProperty->setValue($wrapper, $namespace);
        $prefixProperty = new \ReflectionProperty(get_class($wrapper), 'prefix');
        $prefixProperty->setAccessible(true);
        $prefixProperty->setValue($wrapper, $prefix);
        $wrapper->expects($this->atLeastOnce())
            ->method('getAllowedMethods')
            ->will($this->returnValue(['foobar', 'bimbam']));
        $this->createMockFunction('myfunc_foobar', $namespace, 'fb');
        $this->createMockFunction('myfunc_bimbam', $namespace, 'bb');

        $this->assertEquals('fbTest', $wrapper->foobar('Test'));
        $this->assertEquals('bbTest', $wrapper->bimbam('Test'));
    }

    public function testUndefinedFunctionException()
    {
        $namespace = 'League\Bumble\Test' . time();
        $wrapper = $this->getMockWrapper(['getAllowedMethods']);
        $nsProperty = new \ReflectionProperty(get_class($wrapper), 'namespace');
        $nsProperty->setAccessible(true);
        $nsProperty->setValue($wrapper, $namespace);
        $wrapper->expects($this->atLeastOnce())
            ->method('getAllowedMethods')
            ->will($this->returnValue(['foobar']));

        $this->setExpectedException('\Exception', "Function $namespace\\foobar does not exist!");
        $wrapper->foobar('Test');
    }

    /**
     * @param array $mockedMethods
     *
     * @return FunctionLibWrapper
     */
    protected function getMockWrapper(array $mockedMethods = [])
    {
        $mock = $this->getMockForAbstractClass(
            __NAMESPACE__ . '\FunctionLibWrapper',
            [],
            '',
            true,
            true,
            true,
            $mockedMethods
        );
        return $mock;
    }

    protected function createMockFunction($function, $namespace, $return_prefix)
    {
        if (function_exists($namespace . '\\' . $function)) {
            return;
        }
        $return_prefix = preg_replace('/[^a-z0-9]/i', '', $return_prefix);
        $namespace = $namespace ? "namespace $namespace;" : '';
        $code = <<<EOT
$namespace
function $function()
{
    return '$return_prefix' . func_get_arg(0);
}
EOT;
        eval($code);
    }
}
