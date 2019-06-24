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

namespace Techworker\Ssml\Tests\Traits\Amazon;

use Techworker\Ssml\Element\Amazon\Effect;
use Techworker\Ssml\Element\Audio;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class EffectTraitTest extends TestCase
{
    public function testAdd()
    {
        $speak = SsmlBuilder::factory();
        $speak->effect('whispered');
        $effect = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Effect::class, $effect);
    }
}
