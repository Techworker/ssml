<?php
/**
 * Copyright (c) Benjamin Ansbach - all rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Written by Benjamin Ansbach <benjaminansbach@gmail.com>, 2019
 */
declare(strict_types = 1);
namespace Techworker\Ssml\Element;

use Techworker\Ssml\ContainerElement;

/**
 * Class Voice
 *
 * Generates a voice element.
 *
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#voice
 */
class Voice extends ContainerElement
{
    /**
     * The name.
     *
     * @var string
     */
    public $name;

    /**
     * Creates a voice element with the given name as attribute.
     *
     * @param string $name
     * @return Voice
     */
    public static function factory(string $name): Voice
    {
        $voice = new Voice();
        $voice->name = $name;
        return $voice;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $voice = $doc->createElement('voice');
        $voice->setAttribute('name', $this->name);

        $this->customAttributesToDOM($voice);
        $this->containerToDOM($doc, $voice);

        return $voice;
    }
}
