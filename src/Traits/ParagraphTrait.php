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
use Techworker\Ssml\Element\Paragraph;

/**
 * Class ParagraphTrait
 *
 * Adds a paragraph tag.
 */
trait ParagraphTrait
{
    /**
     * Adds a new paragraph element. If text is provided, this will also be added.
     *
     * @param string|null $text
     * @return Paragraph
     */
    public function p(string $text = null): Paragraph
    {
        return $this->paragraph($text);
    }

    /**
     * Adds a new paragraph element. If text is provided, this will also be added.
     *
     * @param string|null $text
     * @return Paragraph
     */
    public function paragraph(string $text = null): Paragraph
    {
        $paragraph = Paragraph::factory();
        if ($text !== null) {
            $paragraph->text($text);
        }

        /** @var ContainerElement $this */
        return $this->addElement($paragraph);
    }
}
