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
use Techworker\Ssml\Element\Lang;

/**
 * Class LangTrait
 */
trait LangTrait
{
    /**
     * Adds a new sub element.
     *
     * @param string $iso
     * @return Lang
     */
    public function lang(string $iso): Lang
    {
        /** @var ContainerElement $this */
        return $this->addElement(Lang::factory($iso));
    }
}
