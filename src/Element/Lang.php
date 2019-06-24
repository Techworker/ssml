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
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#lang
 */
class Lang extends ContainerElement
{
    /**
     * The iso lang of the effect.
     *
     * @var string
     */
    public $iso;

    /**
     * Creates an effect element with the given name as attribute.
     *
     * @param string $iso
     * @return Lang
     */
    public static function factory(string $iso): Lang
    {
        $lang = new Lang();
        $lang->iso = $iso;
        return $lang;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $lang = $doc->createElement('lang');
        $lang->setAttribute('xml:lang', $this->iso);

        $this->customAttributesToDOM($lang);
        $this->containerToDOM($doc, $lang);

        return $lang;
    }
}
