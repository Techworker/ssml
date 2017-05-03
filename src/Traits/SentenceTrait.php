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
use Techworker\Ssml\Element\Sentence;

/**
 * Class SentenceTrait
 *
 * Adds a sentence tag.
 */
trait SentenceTrait
{
    /**
     * Adds a new sentence element. If a text is provided, it will be added.
     *
     * @param string|null $text
     * @return Sentence
     */
    public function sentence(string $text = null): Sentence
    {
        $sentence = Sentence::factory();
        if ($text !== null) {
            $sentence->text($text);
        }

        /** @var ContainerElement $this */
        return $this->addElement($sentence);
    }

    /**
     * Adds a new sentence element. If a text is provided, it will be added.
     *
     * @param string|null $text
     * @return Sentence
     */
    public function s(string $text = null): Sentence
    {
        return $this->sentence($text);
    }
}
