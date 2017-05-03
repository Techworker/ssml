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
 * Class Phoneme
 *
 * Generates a new Phoneme element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_phoneme
 */
class Phoneme extends EmptyElement
{
    /**
     * The alphabet to use, either ipa or x-sampa.
     *
     * @var string
     */
    public $alphabet;

    /**
     * The pronunciation.
     *
     * @var string
     */
    public $ph;

    /**
     * The text to pronounce in a special way.
     *
     * @var string
     */
    public $text;

    /**
     * Creates a phoneme element with the given data as attributes.
     *
     * @param string $alphabet
     * @param string $ph
     * @param string $text
     *
     * @return Phoneme
     */
    public static function factory(string $alphabet, string $ph, string $text): Phoneme
    {
        $instance = new static();
        $instance->alphabet = $alphabet;
        $instance->ph = $ph;
        $instance->text = $text;

        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $phoneme = $doc->createElement('phoneme', $this->text);

        $phoneme->setAttribute('alphabet', $this->alphabet);
        $phoneme->setAttribute('ph', $this->ph);

        $this->customAttributesToDOM($phoneme);

        return $phoneme;
    }
}
