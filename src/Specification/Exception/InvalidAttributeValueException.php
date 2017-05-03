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

class InvalidAttributeValueException extends SsmlException
{
    /**
     * InvalidAttributeValueException constructor.
     *
     * Creates a new instance of the InvalidAttributeValueException class.
     *
     * @param BaseElement $element
     * @param string $attribute
     * @param string $value
     * @param mixed $allowed
     * @param string $spec
     */
    public function __construct(BaseElement $element, string $attribute, $value, $allowed = null, string $spec = 'ssml')
    {
        parent::__construct(sprintf(
            'Invalid attribute value: The value %s for attribute %s in element %s not allowed in specification %s. Allowed values: %s',
            $value, $attribute, (new \ReflectionClass($element))->getShortName(), $spec,
            is_array($allowed) ? implode(', ', $allowed) : $allowed
        ));
    }
}
