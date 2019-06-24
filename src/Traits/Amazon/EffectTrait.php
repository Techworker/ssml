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
namespace Techworker\Ssml\Traits\Amazon;

use Techworker\Ssml\ContainerElement;
use Techworker\Ssml\Element\Amazon\Effect;

/**
 * Class EffectTrait
 */
trait EffectTrait
{
    /**
     * Adds a new effect element.
     *
     * @param string $name
     * @return Effect
     */
    public function effect(string $name): Effect
    {
        /** @var ContainerElement $this */
        return $this->addElement(Effect::factory($name));
    }
}
