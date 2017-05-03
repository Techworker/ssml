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
namespace Techworker\Ssml;

use Techworker\Ssml\Element\Speak;

/**
 * Class Ssml
 *
 * Basic class to kickstart the fluent building process.
 */
class SsmlBuilder
{
    /**
     * Gets a new Speak element.
     *
     * @return Speak
     */
    public static function factory()
    {
        return Speak::factory();
    }

    /**
     * Gets the xml representation of a tree.
     *
     * @param BaseElement $element
     * @return \DOMDocument
     */
    public static function toDOM(BaseElement $element): \DOMDocument
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->appendChild($element->toDOM($doc));
        return $doc;
    }

    /**
     * Gets the xml representation of a tree.
     *
     * @param \DOMDocument $doc
     * @return string
     */
    public static function toXml(\DOMDocument $doc): string
    {
        return str_replace(
            '<?xml version="1.0" encoding="utf-8"?>' . chr(10), '',
            $doc->saveXML()
        );
    }
}
