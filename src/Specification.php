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
namespace Techworker\Ssml;

use Techworker\Ssml\Element\Speak;
use Techworker\Ssml\Specification\InvalidElementException;

abstract class Specification
{
    /**
     * Gets a list of element classes that are allowed in the specification.
     *
     * @return array
     */
    abstract protected function getAllowedElements(): array;

    /**
     * Validates a single element.
     *
     * @param BaseElement $element
     * @return mixed
     */
    abstract protected function validateElement(BaseElement $element);

    /**
     * Validates a complete element tree.
     *
     * @param Speak $root
     * @throws SsmlException
     */
    public function validate(Speak $root)
    {
        $this->validateAllowed($root);
        $this->validateElement($root);

        foreach ($root->getIterator() as $el) {
            $this->validateElement($el);
        }
    }


    /**
     * Validates a complete element tree.
     *
     * @param Speak $root
     * @throws SsmlException
     */
    protected function validateAllowed(Speak $root)
    {
        $allowedElements = $this->getAllowedElements();

        foreach ($root->getIterator() as $el) {
            if (!in_array(get_class($el), $allowedElements, true)) {
                throw new InvalidElementException($el, 'alexa');
            }
        }
    }
}
