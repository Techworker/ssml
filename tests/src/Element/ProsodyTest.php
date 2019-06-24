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

use Techworker\Ssml\Element\Amazon\Emphasis;
use Techworker\Ssml\Element\Lang;
use Techworker\Ssml\Element\Prosody;
use Techworker\Ssml\Tests\TestCase;

class ProsodyTest extends TestCase
{
    public function testToDOM()
    {
        $element = Prosody::factory('x-slow');
        self::assertEquals('<prosody rate="x-slow"/>', (string)$element);

        $element = Prosody::factory(null, 'x-low');
        self::assertEquals('<prosody pitch="x-low"/>', (string)$element);

        $element = Prosody::factory(null, null, 'silent');
        self::assertEquals('<prosody volume="silent"/>', (string)$element);

        $element = Prosody::factory('x-slow', 'x-low', 'silent');
        self::assertEquals('<prosody rate="x-slow" pitch="x-low" volume="silent"/>', (string)$element);
    }
}
