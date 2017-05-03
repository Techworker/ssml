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

namespace Techworker\Ssml\Tests\Traits;

use Techworker\Ssml\Element\Break_;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class BreakTraitTest extends TestCase
{
    public function testAddEmpty()
    {
        $speak = SsmlBuilder::factory()->brk();
        $break = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Break_::class, $break);
        self::assertNull($break->time);
        self::assertNull($break->strength);
    }


    public function testAddWithStrength()
    {
        $speak = SsmlBuilder::factory()->brkStrength('medium');
        $break = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Break_::class, $break);
        self::assertEquals('medium', $break->strength);
        self::assertNull($break->time);
    }

    public function testAddWithDuration()
    {
        $speak = SsmlBuilder::factory();
        $speak->brkTime('10s');
        $break = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Break_::class, $break);
        self::assertNull($break->strength);
        self::assertEquals('10s', $break->time);
    }
}
