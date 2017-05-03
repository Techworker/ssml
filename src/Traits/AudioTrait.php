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
namespace Techworker\Ssml\Traits;

use Techworker\Ssml\ContainerElement;
use Techworker\Ssml\Element\Audio;

/**
 * Class AudioTrait
 */
trait AudioTrait
{
    /**
     * Adds a new audio element.
     *
     * @param string $src
     * @return Audio
     */
    public function audio(string $src): Audio
    {
        /** @var ContainerElement $this */
        return $this->addElement(Audio::factory($src));
    }
}
