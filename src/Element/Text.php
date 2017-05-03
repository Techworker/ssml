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
 * Class Text
 *
 * A text.
 */
class Text extends EmptyElement
{
    /**
     * The text.
     *
     * @var string
     */
    public $text;

    /**
     * Creates a text node.
     *
     * @param string $text
     * @return Text
     */
    public static function factory(string $text): Text
    {
        $instance = new static();
        $instance->text = $text;
        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        return $doc->createTextNode($this->text);
    }
}
