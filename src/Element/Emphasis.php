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
 * Class Effect
 *
 * Generates an amazon effect element.
 *
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#emphasis
 */
class Emphasis extends ContainerElement
{
    /**
     * The name of the effect.
     *
     * @var string
     */
    public $level;

    /**
     * Creates an emphasis element with the given name as attribute.
     *
     * @param string $level
     * @return Emphasis
     */
    public static function factory(string $level): Emphasis
    {
        $emphasis = new Emphasis();
        $emphasis->level = $level;
        return $emphasis;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $emphasis = $doc->createElement('emphasis');
        $emphasis->setAttribute('level', $this->level);

        $this->customAttributesToDOM($emphasis);
        $this->containerToDOM($doc, $emphasis);

        return $emphasis;
    }
}
