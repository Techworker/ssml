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

use Techworker\Ssml\Element\Prosody;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class ProsodyTraitTest extends TestCase
{
    public function testAdd()
    {
        $speak = SsmlBuilder::factory();
        $speak->prosody('x-slow');
        $prosody = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Prosody::class, $prosody);
    }
}
