<?php
/**
 * Copyright (c) Benjamin Ansbach - all rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Written by Benjamin Ansbach <ben@techworker.de>, 2017
 */
declare(strict_types = 1);
namespace Techworker\Ssml\Traits;

use Techworker\Ssml\ContainerElement;
use Techworker\Ssml\Element\SayAs;

/**
 * Class SayAsTrait
 *
 * Adds a say-as tag.
 */
trait SayAsTrait
{
    /**
     * Adds a new say-as element.
     *
     * @param string $interpretAs
     * @param string $content
     * @param string|null $format
     * @return ContainerElement
     */
    public function sayAs(string $interpretAs, string $content, string $format = null): ContainerElement
    {
        /** @var ContainerElement $this */
        return $this->addElement(SayAs::factory($interpretAs, $content, $format));
    }
}
