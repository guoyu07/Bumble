<?php

namespace League\Bumble\Util;

use PHPUnit_Framework_TestCase;

class FunctionLibWrapperTest extends PHPUnit_Framework_TestCase
{

    public function testMagicCallMethod()
    {
        $this->markTestIncomplete();
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
