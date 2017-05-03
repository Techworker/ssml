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

use Techworker\Ssml\Element\Phoneme;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class PhonemeTraitTest extends TestCase
{
    public function testAdd()
    {
        $speak = SsmlBuilder::factory()->phoneme('ipa', 'abc', 'test');
        $phoneme = $this->access($speak, 'children')[0];
        self::assertInstanceOf(Phoneme::class, $phoneme);
        self::assertEquals('ipa', $phoneme->alphabet);
        self::assertEquals('abc', $phoneme->ph);
        self::assertEquals('test', $phoneme->text);
    }
}
