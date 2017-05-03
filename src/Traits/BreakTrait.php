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
use Techworker\Ssml\Element\Break_;

/**
 * Class BreakTrait
 */
trait BreakTrait
{
    /**
     * Adds an empty break element.
     *
     * @return ContainerElement
     */
    public function brk(): ContainerElement
    {
        /** @var ContainerElement $this */
        return $this->addElement(Break_::factory());
    }

    /**
     * Adds a new break element with the given strength.
     *
     * @param string $strength
     * @return ContainerElement
     */
    public function brkStrength(string $strength): ContainerElement
    {
        /** @var ContainerElement $this */
        return $this->addElement(Break_::factoryWithStrength($strength));
    }

    /**
     * Adds a new break element with the given duration and unit.
     *
     * @param string $time
     * @return ContainerElement
     */
    public function brkTime(string $time): ContainerElement
    {
        return $this->addElement(Break_::factoryWithTime($time));
    }
}
