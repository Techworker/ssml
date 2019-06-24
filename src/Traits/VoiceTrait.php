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
use Techworker\Ssml\Element\Voice;

/**
 * Class VoiceTrait
 */
trait VoiceTrait
{
    /**
     * Adds a new Voice element.
     *
     * @param string $name
     * @return Voice
     */
    public function voice(string $name): Voice
    {
        /** @var ContainerElement $this */
        return $this->addElement(Voice::factory($name));
    }
}
