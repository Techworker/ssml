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
namespace Techworker\Ssml\Traits;

use Techworker\Ssml\ContainerElement;
use Techworker\Ssml\Element\Prosody;

/**
 * Class ProsodyTrait
 */
trait ProsodyTrait
{
    /**
     * Adds a new sub element.
     *
     * @param string $rate
     * @param string $pitch
     * @param string $volume
     * @return Prosody
     */
    public function prosody(string $rate = null, string $pitch = null, string $volume = null): Prosody
    {
        /** @var ContainerElement $this */
        return $this->addElement(Prosody::factory($rate, $pitch, $volume));
    }
}
