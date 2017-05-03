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
use Techworker\Ssml\Element\Text;

/**
 * Class TextTrait
 *
 * Adds text.
 */
trait TextTrait
{
    /**
     * Adds text to the current parent.
     *
     * @param string $text
     * @return ContainerElement
     */
    public function text(string $text): ContainerElement
    {
        /** @var ContainerElement $this */
        return $this->addElement(Text::factory($text));
    }
}
