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

use Techworker\Ssml\Traits\AudioTrait;
use Techworker\Ssml\Traits\BreakTrait;
use Techworker\Ssml\Traits\CustomTrait;
use Techworker\Ssml\Traits\ParagraphTrait;
use Techworker\Ssml\Traits\PhonemeTrait;
use Techworker\Ssml\Traits\SayAsTrait;
use Techworker\Ssml\Traits\SentenceTrait;
use Techworker\Ssml\Traits\TextTrait;
use Techworker\Ssml\Traits\WordTrait;

/**
 * Class ContainerElement
 *
 * An element that can contain other elements.
 */
abstract class ContainerElement extends BaseElement
{
    use AudioTrait;
    use BreakTrait;
    use CustomTrait;
    use ParagraphTrait;
    use PhonemeTrait;
    use SayAsTrait;
    use SentenceTrait;
    use TextTrait;
    use WordTrait;

    /**
     * The children of the current element.
     *
     * @var BaseElement[]
     */
    protected $children = [];

    /**
     * Adds an element instance as a child and returns either itself or the new element if its a
     * container element.
     *
     * @param BaseElement $element
     * @return ContainerElement
     */
    public function addElement(BaseElement $element): ContainerElement
    {
        $element->parent = $this;
        $this->children[] = $element;
        if ($element instanceof ContainerElement) {
            return $element;
        }

        return $this;
    }

    /**
     * Gets the latest added child or null if there isn't any.
     *
     * @return null|EmptyElement
     */
    public function fetch() : ?EmptyElement
    {
        return $this->children[count($this->children) - 1] ?? null;
    }

    /**
     * Returns the parent of the current container.
     *
     * @return ContainerElement|null
     */
    public function up(): ?ContainerElement
    {
        return $this->parent;
    }

    /**
     * Helper function that loops all children and appends them to the given \DomNode.
     *
     * @param \DomDocument $doc
     * @param \DomNode $node
     */
    protected function containerToDOM(\DomDocument $doc, \DomNode $node) : void
    {
        foreach ($this->children as $child) {
            $node->appendChild($child->toDOM($doc));
        }
    }

    /**
     * Gets all children.
     *
     * @return BaseElement[]
     */
    public function children()
    {
        return $this->children;
    }
}
