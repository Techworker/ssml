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
 * Class Paragraph
 *
 * Generates a new Paragraph element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_paragraph
 */
class Paragraph extends ContainerElement
{
    /**
     * Creates a p element.
     *
     * @return Paragraph
     */
    public static function factory(): Paragraph
    {
        return new static();
    }

    /**
     * Adds the element to the given document.
     *
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $paragraph = $doc->createElement('p');

        $this->customAttributesToDOM($paragraph);
        $this->containerToDOM($doc, $paragraph);

        return $paragraph;
    }
}
