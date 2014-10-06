<?php

/**
 * The MIT License
 *
 * Copyright (c) 2010 - 2014 Tony R Quilkey <trq@proemframework.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Proem\Filter\Tests;

use \Mockery as m;

class ChainEventTest extends \PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
        $this->assertInstanceOf('Proem\Filter\ChainEventInterface', m::mock('Proem\Filter\ChainEventInterface'));
    }

    public function testInAndOutAreCalledOnInit()
    {
        $chainEvent = m::mock('Proem\Filter\ChainEventAbstract[in,out]');

        $chainEvent
            ->shouldReceive('in')
            ->with('Proem\Service\AssetManagerInterface')
            ->once();

        $chainEvent
            ->shouldReceive('out')
            ->with('Proem\Service\AssetManagerInterface')
            ->once();

        $chainManager = m::mock('Proem\Filter\ChainManagerInterface');

        $chainManager
            ->shouldReceive('getAssetManager')
            ->twice()
            ->andReturn(m::mock('Proem\Service\AssetManagerInterface'));

        $chainManager
            ->shouldReceive('hasEvents')
            ->once()
            ->andReturn(true);

        $chainManager
            ->shouldReceive('getNextEvent')
            ->once()
            ->andReturn(false); // We are not interested in going any further with this test.

        $chainEvent->init($chainManager);
    }

}
