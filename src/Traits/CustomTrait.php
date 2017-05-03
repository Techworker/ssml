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
use Techworker\Ssml\Element\Custom;

/**
 * Class CustomTrait
 *
 * Adds a custom tag.
 */
trait CustomTrait
{
    /**
     * Adds a new custom element.
     *
     * @param string $name
     * @param array $attributes
     * @return Custom
     */
    public function custom(string $name, array $attributes): Custom
    {
        /** @var ContainerElement $this */
        return $this->addElement(Custom::factory($name, $attributes));
    }
}
