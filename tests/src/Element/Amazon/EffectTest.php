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

namespace Techworker\Ssml\Tests\Element\Amazon;

use Techworker\Ssml\Element\Amazon\Effect;
use Techworker\Ssml\Element\Audio;
use Techworker\Ssml\Tests\TestCase;

class EffectTest extends TestCase
{
    public function testToDOM()
    {
        $element = Effect::factory('whispered');
        self::assertEquals('<amazon:effect name="whispered"/>', (string)$element);
    }
}
