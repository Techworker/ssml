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
 * Class Speak
 *
 * Generates a speak root element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_speak
 */
class Speak extends ContainerElement
{
    /**
     * Creates a speak element.
     *
     * @return Speak
     */
    public static function factory(): Speak
    {
        return new static();
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $speak = $doc->createElement('speak');

        $this->customAttributesToDOM($speak);
        $this->containerToDOM($doc, $speak);

        return $speak;
    }
}
