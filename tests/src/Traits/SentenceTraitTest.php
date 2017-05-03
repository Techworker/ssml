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

use Techworker\Ssml\Element\Sentence;
use Techworker\Ssml\Element\Text;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class SentenceTraitTest extends TestCase
{
    public function testAddSimple()
    {
        $speak = SsmlBuilder::factory();
        $s = $speak->sentence();
        self::assertInstanceOf(Sentence::class, $s);
    }

    public function testAddWithText()
    {
        $speak = SsmlBuilder::factory();
        $s = $speak->sentence("test123");
        self::assertInstanceOf(Sentence::class, $s);
        $this->assertInstanceOf(Text::class, $this->access($s, 'children')[0]);
    }

    public function testAddSimpleS()
    {
        $speak = SsmlBuilder::factory();
        $s = $speak->s();
        self::assertInstanceOf(Sentence::class, $s);
    }

    public function testAddWithTextS()
    {
        $speak = SsmlBuilder::factory();
        $s = $speak->s("test123");
        self::assertInstanceOf(Sentence::class, $s);
        $this->assertInstanceOf(Text::class, $this->access($s, 'children')[0]);
    }
}
