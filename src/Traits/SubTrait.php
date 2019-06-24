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
use Techworker\Ssml\Element\Sub;

/**
 * Class SubTrait
 */
trait SubTrait
{
    /**
     * Adds a new sub element.
     *
     * @param string $alias
     * @param string $text
     * @return Sub
     */
    public function sub(string $alias, string $text = null): Sub
    {
        $sub = Sub::factory($alias);
        if ($text !== null) {
            $sub->text($text);
        }

        /** @var ContainerElement $this */
        return $this->addElement($sub);
    }
}
