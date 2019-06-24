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
namespace Techworker\Ssml\Element\Amazon;

use Techworker\Ssml\ContainerElement;

/**
 * Class Effect
 *
 * Generates an amazon effect element.
 *
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#amazon-effect
 */
class Effect extends ContainerElement
{
    /**
     * The name of the effect.
     *
     * @var string
     */
    public $name;

    /**
     * Creates an effect element with the given name as attribute.
     *
     * @param string $name
     * @return Effect
     */
    public static function factory(string $name): Effect
    {
        $effect = new Effect();
        $effect->name = $name;
        return $effect;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $effect = $doc->createElement('amazon:effect');
        $effect->setAttribute('name', $this->name);

        $this->customAttributesToDOM($effect);
        $this->containerToDOM($doc, $effect);

        return $effect;
    }
}
