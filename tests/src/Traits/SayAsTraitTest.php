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

use Techworker\Ssml\Element\SayAs;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class SayAsTraitTest extends TestCase
{
    public function testAdd()
    {
        $speak = SsmlBuilder::factory()->sayAs('date', 'foobar', 'd');
        $sayAs = $this->access($speak, 'children')[0];
        self::assertInstanceOf(SayAs::class, $sayAs);
        self::assertEquals('date', $sayAs->interpretAs);
        self::assertEquals('foobar', $sayAs->content);
        self::assertEquals('d', $sayAs->format);
    }
}