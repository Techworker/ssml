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

use Techworker\Ssml\AbstractElement;
use Techworker\Ssml\Element\Break_;
use Techworker\Ssml\Element\Paragraph;
use Techworker\Ssml\Element\Sentence;
use Techworker\Ssml\Element\Speak;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class ContainerElementTest extends TestCase
{
    public function testAddLeaf()
    {
        $root = SsmlBuilder::factory();
        $brk = new Break_();
        $rootSame = $this->call($root, 'addElement', $brk);
        static::assertEquals($root, $rootSame);
        static::assertInstanceOf(Speak::class, $brk->root());
        static::assertInstanceOf(Speak::class, $this->access($brk, 'parent'));
    }

    public function testAddContainer()
    {
        $root = SsmlBuilder::factory();
        $para = new Paragraph($root);
        $rootPara = $this->call($root, 'addElement', $para);
        static::assertEquals($para, $rootPara);
        static::assertInstanceOf(Speak::class, $para->root());
        static::assertInstanceOf(Speak::class, $this->access($para, 'parent'));
    }

    public function testUp()
    {
        $lastContainer = SsmlBuilder::factory()->paragraph()->sentence()->paragraph();
        static::assertInstanceOf(Paragraph::class, $lastContainer);
        static::assertInstanceOf(Sentence::class, $lastContainer->up());
        static::assertInstanceOf(Paragraph::class, $lastContainer->up()->up());
    }

    public function testFetch()
    {
        static::assertInstanceOf(Break_::class, SsmlBuilder::factory()->brk()->fetch());
    }

    public function testContainerToDom()
    {
        $container = SsmlBuilder::factory()->p('hallo')->up()->p('foo')->root();
        self::assertEquals('<speak><p>hallo</p><p>foo</p></speak>', (string)$container);
    }
}