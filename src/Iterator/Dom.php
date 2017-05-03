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

namespace Techworker\Ssml\Iterator;

class Dom implements \RecursiveIterator
{
    /**
     * Current Position in DOMNodeList
     * @var Integer
     */
    protected $itx;

    /**
     * The DOMNodeList with all children to iterate over
     * @var \DOMNodeList
     */
    protected $nodes;

    /**
     * @param \DOMNode $domNode
     */
    public function __construct(\DOMNode $domNode)
    {
        $this->itx = 0;
        $this->nodes = $domNode->childNodes;
    }

    /**
     * Returns the current DOMNode
     * @return \DOMNode
     */
    public function current()
    {
        return $this->nodes->item($this->itx);
    }

    /**
     * Returns an iterator for the current iterator entry
     * @return Dom
     */
    public function getChildren() : Dom
    {
        return new self($this->current());
    }

    /**
     * Returns if an iterator can be created for the current entry.
     * @return Boolean
     */
    public function hasChildren()
    {
        return $this->current()->hasChildNodes();
    }

    /**
     * Returns the current position
     * @return Integer
     */
    public function key()
    {
        return $this->itx;
    }

    /**
     * Moves the current position to the next element.
     * @return void
     */
    public function next()
    {
        $this->itx++;
    }

    /**
     * Rewind the Iterator to the first element
     * @return void
     */
    public function rewind()
    {
        $this->itx = 0;
    }

    /**
     * Checks if current position is valid
     * @return Boolean
     */
    public function valid()
    {
        return $this->itx < $this->nodes->length;
    }
}
