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
 * Class Prosody
 *
 * Generates an prosody element.
 *
 * @link https://developer.amazon.com/de/docs/custom-skills/speech-synthesis-markup-language-ssml-reference.html#prosody
 */
class Prosody extends ContainerElement
{
    /**
     * The rate.
     *
     * @var string
     */
    public $rate;

    /**
     * The pitch.
     *
     * @var string
     */
    public $pitch;

    /**
     * The volume.
     *
     * @var string
     */
    public $volume;

    /**
     * Creates an prosody element with the given name as attribute.
     *
     * @param string|null $rate
     * @param string|null $pitch
     * @param string|null $volume
     * @return Lang
     */
    public static function factory(string $rate = null, string $pitch = null, string $volume = null): Prosody
    {
        $prosody = new Prosody();
        $prosody->rate = $rate;
        $prosody->pitch = $pitch;
        $prosody->volume = $volume;

        return $prosody;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $prosody = $doc->createElement('prosody');
        if ($this->rate !== null) {
            $prosody->setAttribute('rate', $this->rate);
        }

        if ($this->pitch !== null) {
            $prosody->setAttribute('pitch', $this->pitch);
        }

        if ($this->volume !== null) {
            $prosody->setAttribute('volume', $this->volume);
        }

        $this->customAttributesToDOM($prosody);
        $this->containerToDOM($doc, $prosody);

        return $prosody;
    }
}
