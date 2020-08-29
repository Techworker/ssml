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
use Techworker\Ssml\Element\Emphasis;

/**
 * Class EmphasisTrait
 */
trait EmphasisTrait
{
    /**
     * Adds a new emphasis element.
     *
     * @param string $level
     * @return Emphasis
     */
    public function emphasis(string $level): Emphasis
    {
        /** @var ContainerElement $this */
        return $this->addElement(Emphasis::factory($level));
    }
}
