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

use Techworker\Ssml\ContainerElement;

class Element extends \ArrayIterator implements \RecursiveIterator
{
    /**
     * @inheritdoc
     */
    public function hasChildren()
    {
        return $this->current() instanceof ContainerElement &&
            count($this->current()->children()) > 0;
    }

    /**
     * @inheritdoc
     */
    public function getChildren()
    {
        return new self($this->current()->children());
    }
}
