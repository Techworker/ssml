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
use Techworker\Ssml\Element\Sub;
use Techworker\Ssml\Element\Text;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class SubTraitTest extends TestCase
{
    public function testAddSimple()
    {
        $speak = SsmlBuilder::factory();
        $sub = $speak->sub('aluminium');
        self::assertInstanceOf(Sub::class, $sub);
    }

    public function testAddWithText()
    {
        $speak = SsmlBuilder::factory();
        $sub = $speak->sub('aluminium', 'al');
        self::assertInstanceOf(Sub::class, $sub);
        $this->assertInstanceOf(Text::class, $this->access($sub, 'children')[0]);
    }
}
