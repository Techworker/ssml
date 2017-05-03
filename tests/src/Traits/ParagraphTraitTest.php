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

use Techworker\Ssml\Element\Paragraph;
use Techworker\Ssml\Element\Text;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class ParagraphTraitTest extends TestCase
{
    public function testAddSimple()
    {
        $speak = SsmlBuilder::factory();
        $p = $speak->paragraph();
        self::assertInstanceOf(Paragraph::class, $p);
    }

    public function testAddWithText()
    {
        $speak = SsmlBuilder::factory();
        $p = $speak->paragraph("test123");
        self::assertInstanceOf(Paragraph::class, $p);
        $this->assertInstanceOf(Text::class, $this->access($p, 'children')[0]);
    }


    public function testAddSimpleP()
    {
        $speak = SsmlBuilder::factory();
        $p = $speak->p();
        self::assertInstanceOf(Paragraph::class, $p);
    }

    public function testAddWithTextP()
    {
        $speak = SsmlBuilder::factory();
        $p = $speak->p("test123");
        self::assertInstanceOf(Paragraph::class, $p);
        $this->assertInstanceOf(Text::class, $this->access($p, 'children')[0]);
    }
}