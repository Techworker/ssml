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
 * Class AudioElement
 *
 * Generates an audio element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#S3.3.1
 */
class Audio extends ContainerElement
{
    /**
     * The src attribute.
     *
     * @var string
     */
    public $src;

    /**
     * Creates an audio element with the given src as attribute.
     *
     * @param string $src
     * @return Audio
     */
    public static function factory(string $src): Audio
    {
        $audio = new Audio();
        $audio->src = $src;
        return $audio;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $audio = $doc->createElement('audio');
        $audio->setAttribute('src', $this->src);

        $this->customAttributesToDOM($audio);
        $this->containerToDOM($doc, $audio);

        return $audio;
    }
}
