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
 * Class Sentence
 *
 * Generates a sentence element.
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_sentence
 */
class Sentence extends ContainerElement
{
    /**
     * Creates a s element.
     *
     * @return Sentence
     */
    public static function factory(): Sentence
    {
        return new static();
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $sentence = $doc->createElement('s');

        $this->customAttributesToDOM($sentence);
        $this->containerToDOM($doc, $sentence);

        return $sentence;
    }
}
