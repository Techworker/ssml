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

use Techworker\Ssml\Element\Text;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class TextTraitTest extends TestCase
{
    public function testAdd()
    {
        $speak = SsmlBuilder::factory();
        $speak->text('foobar');
        $text = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Text::class, $text);
        self::assertEquals('foobar', $text->text);
    }
}
