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

namespace Techworker\Ssml\Specification;

use Techworker\Ssml\BaseElement;
use Techworker\Ssml\Element\Emphasis;
use Techworker\Ssml\Element\Lang;
use Techworker\Ssml\Element\Audio;
use Techworker\Ssml\Element\Break_;
use Techworker\Ssml\Element\Paragraph;
use Techworker\Ssml\Element\Phoneme;
use Techworker\Ssml\Element\Prosody;
use Techworker\Ssml\Element\SayAs;
use Techworker\Ssml\Element\Sentence;
use Techworker\Ssml\Element\Speak;
use Techworker\Ssml\Element\Sub;
use Techworker\Ssml\Element\Text;
use Techworker\Ssml\Element\Voice;
use Techworker\Ssml\Element\Word;
use Techworker\Ssml\Specification;
use Techworker\Ssml\SsmlException;

/**
 * Class Alexa
 *
 * A validator for the alexa specification.
 */
class Alexa extends Specification
{
    public const BREAK_STRENGTHS = ['none', 'x-weak', 'weak', 'medium', 'strong', 'x-strong'];
    public const EMPHASIS_LEVELS = ['strong', 'moderate', 'reduced'];
    public const EFFECT_NAMES = ['whispered'];
    public const PHONEME_ALPHABETS = ['ipa', 'x-sampa'];
    public const SAY_AS_INTERPRET_AS =  ['characters', 'spell-out', 'cardinal', 'number',
        'ordinal', 'digits', 'fraction', 'unit', 'date', 'time', 'telephone',
        'address', 'interjection', 'expletive'];
    public const SAY_AS_DATE_FORMATS = ['mdy', 'dmy', 'ymd', 'md', 'dm', 'ym', 'my', 'd', 'm', 'y'];
    public const WORD_ROLES = ['amazon:VB', 'amazon:VBD', 'amazon:NN', 'amazon:SENSE_1'];

    /**
     * Gets the allowed elements.
     *
     * @return array
     */
    protected function getAllowedElements() : array
    {
        return [
            Lang::class,
            Sub::class,
            Prosody::class,
            Voice::class,
            Emphasis::class,
            Speak::class,
            Audio::class,
            Break_::class,
            Paragraph::class,
            Phoneme::class,
            Sentence::class,
            SayAs::class,
            Word::class,
            Text::class
        ];
    }

    /**
     * Calls validation methods based on the givene element.
     *
     * @param BaseElement $element
     * @return void
     */
    protected function validateElement(BaseElement $element) : void
    {
        if ($element instanceof Break_) {
            $this->validateBreak($element);
        } elseif ($element instanceof Phoneme) {
            $this->validatePhoneme($element);
        } elseif ($element instanceof SayAs) {
            $this->validateSayAs($element);
        } elseif ($element instanceof Word) {
            $this->validateWord($element);
        } elseif ($element instanceof Word) {
            $this->validateEffect($element);
        } elseif ($element instanceof Emphasis) {
            $this->validateEmphasis($element);
        }
    }

    /**
     * Validates a Break_ element.
     *
     * @param Break_ $break
     * @throws InvalidAttributeValueException
     */
    protected function validateBreak(Break_ $break)
    {
        $strength = $break->strength;
        if ($strength !== null && !in_array($strength, self::BREAK_STRENGTHS, true)) {
            throw new InvalidAttributeValueException(
                $break, 'strength', $strength, self::BREAK_STRENGTHS, 'alexa'
            );
        }

        $time = $break->time;
        if ($time !== null && preg_match('/^\d+m*s+$/', $time) === 0) {
            throw new InvalidAttributeValueException(
                $break, 'time', $time, '\d[m*s+]', 'alexa'
            );
        }
    }

    /**
     * Validates a Phoneme element.
     *
     * @param Phoneme $phoneme
     * @throws InvalidAttributeValueException
     */
    protected function validatePhoneme(Phoneme $phoneme)
    {
        $alphabet = $phoneme->alphabet;
        if (!in_array($alphabet, self::PHONEME_ALPHABETS, true)) {
            throw new InvalidAttributeValueException(
                $phoneme, 'alphabet', $alphabet, self::PHONEME_ALPHABETS, 'alexa'
            );
        }
    }

    /**
     * Validates an Effect element.
     *
     * @param Lang $effect
     * @throws InvalidAttributeValueException
     */
    protected function validateEffect(Lang $effect)
    {
        $name = $effect->name;
        if (!in_array($name, self::EFFECT_NAMES, true)) {
            throw new InvalidAttributeValueException(
                $effect, 'name', $name, self::EFFECT_NAMES, 'alexa'
            );
        }
    }

    /**
     * Validates an Effect element.
     *
     * @param Emphasis $emphasis
     * @throws InvalidAttributeValueException
     */
    protected function validateEmphasis(Emphasis $emphasis)
    {
        $level = $emphasis->level;
        if (!in_array($level, self::EMPHASIS_LEVELS, true)) {
            throw new InvalidAttributeValueException(
                $emphasis, 'level', $level, self::EMPHASIS_LEVELS, 'alexa'
            );
        }
    }

    /**
     * Validates a SayAs element.
     *
     * @param SayAs $sayAs
     * @throws SsmlException
     */
    protected function validateSayAs(SayAs $sayAs)
    {
        $interpretAs = $sayAs->interpretAs;
        if (!in_array($interpretAs, self::SAY_AS_INTERPRET_AS, true)) {
            throw new InvalidAttributeValueException(
                $sayAs, 'interpret-as', $interpretAs, self::SAY_AS_INTERPRET_AS, 'alexa'
            );
        }

        $format = $sayAs->format;
        if ($interpretAs === 'date') {
            if (!in_array($format, self::SAY_AS_DATE_FORMATS, true)) {
                throw new InvalidAttributeValueException(
                    $sayAs, 'format', $format, self::SAY_AS_DATE_FORMATS, 'alexa'
                );
            }
        }

        // We will not check interjection values.
    }

    /**
     * Validates a Word element.
     *
     * @param Word $word
     * @throws SsmlException
     */
    protected function validateWord(Word $word)
    {
        $role = $word->role;
        if (!in_array($role, self::WORD_ROLES, true)) {
            throw new InvalidAttributeValueException(
                $word, 'role', $role, self::WORD_ROLES, 'alexa'
            );
        }
    }
}
