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
 * Class SayAs
 *
 * Generates a new <say-as..> element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_say-as
 */
class SayAs extends EmptyElement
{
    /**
     * The interpretation.
     *
     * @var string
     */
    public $interpretAs;

    /**
     * The format if interpret-as equals date.
     *
     * @var string
     */
    public $format;

    /**
     * The content to interpret.
     *
     * @var string
     */
    public $content;

    /**
     * Creates a say-as element with the given values as attributes.
     *
     * @param string $interpretAs
     * @param string $content
     * @param string|null $format
     * @return static
     */
    public static function factory(string $interpretAs, string $content, string $format = null)
    {
        $instance = new static();
        $instance->interpretAs = $interpretAs;
        $instance->content = $content;
        $instance->format = $format;

        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $sayAs = $doc->createElement('say-as', $this->content);

        $sayAs->setAttribute('interpret-as', $this->interpretAs);
        $sayAs->setAttribute('format', $this->format);

        $this->customAttributesToDOM($sayAs);

        return $sayAs;
    }
}
