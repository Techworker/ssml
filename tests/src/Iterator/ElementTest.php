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

namespace Techworker\Ssml\Tests\Iterator\Element;

use Techworker\Ssml\Element\Break_;
use Techworker\Ssml\Element\Text;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class ElementTest extends TestCase
{
    public function testGetChildren()
    {
        $p = SsmlBuilder::factory()->p('foo')->brk();
        $children = $p->getIterator()->callGetChildren();
        self::assertInstanceOf(Text::class, $children[0]);
        self::assertInstanceOf(Break_::class, $children[1]);
    }

    public function testHasChildren()
    {
        $p = SsmlBuilder::factory()->p('foo')->brk();
        $hasChildren = $p->getIterator()->callHasChildren();
        self::assertTrue($hasChildren);

        $speak = SsmlBuilder::factory();
        $hasChildren = $speak->getIterator()->callHasChildren();
        self::assertFalse($hasChildren);
    }
}
