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

namespace Techworker\Ssml\Tests\Element;

use Techworker\Ssml\Element\Audio;
use Techworker\Ssml\Tests\TestCase;

class AudioTest extends TestCase
{
    public function testToDOM()
    {
        $element = Audio::factory('test');
        self::assertEquals('<audio src="test"/>', (string)$element);
    }
}