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
use Techworker\Ssml\Element\Word;

/**
 * Class WordTrait
 *
 * Adds a w tag.
 */
trait WordTrait
{
    /**
     * Adds a word element.
     *
     * @param string $role
     * @param string $text
     *
     * @return ContainerElement
     */
    public function word(string $role, string $text): ContainerElement
    {
        /** @var ContainerElement $this */
        return $this->addElement(Word::factory($role, $text));
    }

    /**
     * Adds a word element.
     *
     * @param string $role
     * @param string $text
     *
     * @return ContainerElement
     */
    public function w(string $role, string $text): ContainerElement
    {
        return $this->word($role, $text);
    }
}
