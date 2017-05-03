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

namespace Techworker\Ssml\Specification;

use Techworker\Ssml\BaseElement;
use Techworker\Ssml\SsmlException;

class InvalidElementException extends SsmlException
{
    /**
     * InvalidElementException constructor.
     *
     * Creates a new instance of the InvalidElementException class.
     *
     * @param BaseElement $element
     * @param string $spec
     */
    public function __construct(BaseElement $element, string $spec = 'ssml')
    {
        parent::__construct(sprintf(
            'Element %s not allowed for specification %s.',
            (new \ReflectionClass($element))->getShortName(), $spec
        ));
    }
}
