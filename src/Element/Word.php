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

use Techworker\Ssml\EmptyElement;

/**
 * Class Word
 *
 * Generates a new "w" element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_phoneme
 */
class Word extends EmptyElement
{
    /**
     * The role.
     *
     * @var string
     */
    public $role;

    /**
     * The word.
     *
     * @var string
     */
    public $text;

    /**
     * Creates a word element with the given data as attributes.
     *
     * @param string $role
     * @param string $text
     *
     * @return Word
     */
    public static function factory(string $role, string $text): Word
    {
        $instance = new static();
        $instance->role = $role;
        $instance->text = $text;

        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $word = $doc->createElement('w', $this->text);
        $word->setAttribute('role', $this->role);
        $this->customAttributesToDOM($word);

        return $word;
    }
}
