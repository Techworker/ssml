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

use Techworker\Ssml\Element\Speak;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class AbstractBaseElementTest extends TestCase
{
    public function testRoot()
    {
        $p = SsmlBuilder::factory()->paragraph()->paragraph();
        static::assertInstanceOf(Speak::class, $p->root());

        $speak = SsmlBuilder::factory();
        static::assertInstanceOf(Speak::class, $speak->root());
    }

    public function testAttr()
    {
        $el = SsmlBuilder::factory();
        $el->attr('foo', 'bar');
        static::assertEquals('bar', $this->access($el, 'customAttributes')['foo']);
        $el->attr('foo2', 'bar');
        static::assertEquals('bar', $this->access($el, 'customAttributes')['foo2']);

        $foo2 = $el->attr('foo2');
        static::assertEquals('bar', $foo2);
    }

    /**
     * @expectedException \Techworker\Ssml\SsmlException
     */
    public function testAttrEx()
    {
        $el = SsmlBuilder::factory();
        $el->attr('foo');
    }

    public function testGetsIterator()
    {
        $el = SsmlBuilder::factory();
        static::assertInstanceOf(\RecursiveIteratorIterator::class, $el->getIterator());
    }

    public function testContainerToDom()
    {
        $el = SsmlBuilder::factory()->s('test')->brk();
        static::assertInstanceOf(\RecursiveIteratorIterator::class, $el->getIterator());
    }
}
