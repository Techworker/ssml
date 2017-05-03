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
namespace Techworker\Ssml;

use Techworker\Ssml\Element\Speak;
use Techworker\Ssml\Iterator\Dom;

/**
 * Class AbstractElement
 *
 * Basic abstract element for all SSML elements.
 */
abstract class BaseElement implements \IteratorAggregate
{
    /**
     * The parent container, can either be null (topmost) or the immediate parent. But at least
     * it needs to be a container element.
     *
     * @var null|ContainerElement
     */
    protected $parent;

    /**
     * A list of unmanaged custom attributes.
     *
     * @var array
     */
    protected $customAttributes = [];

    /**
     * Gets the topmost root element of the current ssml-tree.
     *
     * @return ContainerElement
     */
    public function root() : ContainerElement
    {
        // no need to check anything else, we are at the top
        if ($this instanceof Speak) {
            return $this;
        }

        // loop until we find an element that has no parent
        $currentParent = $this->parent;
        while ($currentParent->parent !== null) {
            $currentParent = $currentParent->parent;
        }

        return $currentParent;
    }

    /**
     * Adds an unmanaged custom attribute to the element or gets an attribute either from the list
     * of custom attributes.
     *
     * @param string $name The name of the attribute.
     * @param string $value The value of the attribute.
     * @throws SsmlException
     * @return static
     */
    public function attr(string $name, string $value = null)
    {
        if ($value === null) {
            if (isset($this->customAttributes[$name])) {
                return $this->customAttributes[$name];
            }

            throw new SsmlException('Unknown attribute ' . $name . ' in class ' . get_class($this));
        }

        $this->customAttributes[$name] = $value;
        return $this;
    }

    /**
     * Gets the xml representation of the current object and its children.
     *
     * @return string
     */
    public function __toString(): string
    {
        return trim(SsmlBuilder::toXml(SsmlBuilder::toDOM($this)));
    }

    /**
     * Sets the custom attributes in the given \DomElement instance.
     *
     * @param \DOMElement $element
     */
    protected function customAttributesToDOM(\DOMElement $element) : void
    {
        foreach ($this->customAttributes as $key => $value) {
            $element->setAttribute($key, $value);
        }
    }

    /**
     * Takes the information of the element and writes it to the given document instance.
     *
     * @param \DOMDocument $doc
     * @return \DomNode
     */
    abstract public function toDOM(\DOMDocument $doc): \DOMNode;

    /**
     * @inheritdoc
     * @return \RecursiveIteratorIterator
     */
    public function getIterator()
    {
        return new \RecursiveIteratorIterator(
            new Iterator\Element(
                Speak::factory()->addElement($this)->up()->children() // hack
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );
    }

    /**
     * Gets the dom iterator for the given element.
     *
     * @return \RecursiveIteratorIterator
     */
    public function getDomIterator()
    {
        return new \RecursiveIteratorIterator(
            new Dom(SsmlBuilder::toDOM($this)),
            \RecursiveIteratorIterator::SELF_FIRST
        );
    }
}
