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
namespace Techworker\Ssml\Element;

use Techworker\Ssml\ContainerElement;

/**
 * Class Custom
 *
 * Generates a new custom element with the given name and attributes. This is just in case someone
 * might need something special.
 */
class Custom extends ContainerElement
{
    /**
     * The name of the element.
     *
     * @var string
     */
    public $name;

    /**
     * Creates a custom element with the given name and attributes.
     *
     * @param string $name The name of the element.
     * @param array $attributes The attributes [key => value]
     * @return Custom
     */
    public static function factory(string $name, array $attributes = []): Custom
    {
        $instance = new static();
        $instance->name = $name;
        $instance->customAttributes = $attributes;

        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $custom = $doc->createElement($this->name);
        $this->customAttributesToDOM($custom);
        $this->containerToDOM($doc, $custom);

        return $custom;
    }
}
