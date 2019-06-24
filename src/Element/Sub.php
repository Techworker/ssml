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
 * Class Sub
 *
 * Generates a sub element.
 *
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#sub
 */
class Sub extends ContainerElement
{
    /**
     * The alias.
     *
     * @var string
     */
    public $alias;

    /**
     * Creates an effect element with the given name as attribute.
     *
     * @param string $alias
     * @return Sub
     */
    public static function factory(string $alias): Sub
    {
        $sub = new Sub();
        $sub->alias = $alias;
        return $sub;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $sub = $doc->createElement('sub');
        $sub->setAttribute('alias', $this->alias);

        $this->customAttributesToDOM($sub);
        $this->containerToDOM($doc, $sub);

        return $sub;
    }
}
