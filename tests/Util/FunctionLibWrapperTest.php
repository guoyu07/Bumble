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
}
