<?php
/**
 * Copyright (c) Zandura GmbH - all rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Written by Benjamin Ansbach <benjamin.ansbach@zandura.net>, 2016
 */
declare(strict_types = 1);

namespace Techworker\Ssml\Tests\Element;

use Techworker\Ssml\Element\Break_;
use Techworker\Ssml\StrictException;
use Techworker\Ssml\Tests\TestCase;

class BreakTest extends TestCase
{
    public function testSimpleFactory()
    {
        $element = Break_::factory();
        self::assertEquals('<break/>', (string)$element);
    }

    public function testFactoryWithStrength()
    {
        $element = Break_::factoryWithStrength('test');
        self::assertEquals('<break strength="test"/>', (string)$element);
    }

    public function testFactoryWithTime()
    {
        $element = Break_::factoryWithTime('10s');
        self::assertEquals('<break time="10s"/>', (string)$element);
    }
}