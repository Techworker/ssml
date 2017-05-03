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

namespace Techworker\Ssml\Tests;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Techworker\Ssml\AbstractElement;
use Techworker\Ssml\BaseElement;

abstract class TestCase extends PhpUnitTestCase
{
    /**
     * Helper function to fetch a private protected properties value.
     *
     * @param BaseElement $element
     * @param string $property
     * @return mixed
     */
    protected function access(BaseElement $element, string $property)
    {
        $prop = new \ReflectionProperty(get_class($element), $property);
        $prop->setAccessible(true);
        return $prop->getValue($element);
    }

    protected function call($obj, $name, ...$params)
    {
        $method = new \ReflectionMethod(get_class($obj), $name);
        $method->setAccessible(true);
        return $method->invoke($obj, ...$params);
    }
}
