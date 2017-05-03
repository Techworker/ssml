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
 * Class Break_
 *
 * Generates a break element.
 *
 * @link https://www.w3.org/TR/speech-synthesis11/#edef_break
 */
class Break_ extends EmptyElement
{
    /**
     * The strength of the break.
     *
     * @var null|string
     */
    public $strength;

    /**
     * The duration of the break in either seconds or milliseconds indicated by a trailing
     * "s" or "ms".
     *
     * @var null|string
     */
    public $time;

    /**
     * Creates a simple break element without any attributes.
     *
     * @return Break_
     */
    public static function factory(): Break_
    {
        return new static();
    }

    /**
     * Creates a break element with the strength attribute set.
     *
     * @param string $strength
     * @return Break_
     */
    public static function factoryWithStrength(string $strength): Break_
    {
        $instance = new static();
        $instance->strength = $strength;
        return $instance;
    }

    /**
     * Creates a break element with the time attribute set.
     *
     * @param string $time
     * @return Break_
     */
    public static function factoryWithTime(string $time): Break_
    {
        $instance = new static();
        $instance->time = $time;
        return $instance;
    }

    /**
     * @inheritdoc
     */
    public function toDOM(\DOMDocument $doc): \DOMNode
    {
        $break = $doc->createElement('break');
        if ($this->strength !== null) {
            $break->setAttribute('strength', $this->strength);
        }

        if ($this->time !== null) {
            $break->setAttribute('time', $this->time);
        }

        $this->customAttributesToDOM($break);

        return $break;
    }
}
