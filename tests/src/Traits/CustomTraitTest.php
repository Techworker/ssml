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

use Techworker\Ssml\Element\Custom;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class CustomTraitTest extends TestCase
{
    public function testAdd()
    {
        $custom = SsmlBuilder::factory()->custom('foo', [1, 2, 3]);
        self::assertInstanceOf(Custom::class, $custom);
        self::assertEquals('foo', $custom->name);
        self::assertEquals([1, 2, 3], $this->access($custom, 'customAttributes'));
    }
}
