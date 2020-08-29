<?php
/**
 * Copyright (c) Zandura GmbH - all rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Written by Benjamin Ansbach <benjamin.ansbach@zandura.net>, 2016
 */
declare(strict_types = 1);

namespace Techworker\Ssml\Tests\Specification;

use Techworker\Ssml\Specification\Exception\Alexa;
use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class AlexaTest extends TestCase
{
    /**
     * @expectedException \Techworker\Ssml\Specification\Exception\InvalidElementException
     */
    public function testNotAllowedElementThrowsException()
    {
        $ssml = SsmlBuilder::factory()->p('foo')->custom('hello', [])->root();
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute strength/
     */
    public function testBreakStrengthInvalid()
    {
        $ssml = SsmlBuilder::factory()->brkStrength('foo');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testBreakStrengthValid()
    {
        foreach (Alexa::BREAK_STRENGTHS as $strength) {
            $ssml = SsmlBuilder::factory()->brkStrength($strength);
            $spec = new Alexa();
            $spec->validate($ssml);
            static::addToAssertionCount(1);
        }
    }


    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute time/
     */
    public function testBreakTimeInvalid()
    {
        $ssml = SsmlBuilder::factory()->brkTime('10m');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute time/
     */
    public function testBreakTimeInvalid2()
    {
        $ssml = SsmlBuilder::factory()->brkTime('10');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testBreakTimeValid()
    {
        $ssml = SsmlBuilder::factory()->brkTime('10s');
        $spec = new Alexa();
        $spec->validate($ssml);
        static::addToAssertionCount(1);
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute alphabet/
     */
    public function testPhonemeAlphabetInvalid()
    {
        $ssml = SsmlBuilder::factory()->phoneme('foo', 'A', 'foo');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testPhonemeAlphabetValid()
    {
        foreach (Alexa::PHONEME_ALPHABETS as $alphabet) {
            $ssml = SsmlBuilder::factory()->phoneme($alphabet, 'A', 'foo');
            $spec = new Alexa();
            $spec->validate($ssml);
            static::addToAssertionCount(1);
        }
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute interpret-as/
     */
    public function testSayAsInterpretAsInvalid()
    {
        $ssml = SsmlBuilder::factory()->sayAs('abc', 'A', null);
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testSayAsInterpretAsValid()
    {
        foreach (Alexa::SAY_AS_INTERPRET_AS as $interpretAs) {
            $format = null;
            if ($interpretAs === 'date') {
                $format = 'mdy';
            }
            $ssml = SsmlBuilder::factory()->sayAs($interpretAs, 'A', $format);
            $spec = new Alexa();
            $spec->validate($ssml);
            static::addToAssertionCount(1);
        }
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute format/
     */
    public function testSayAsDateFormatInvalid()
    {
        $ssml = SsmlBuilder::factory()->sayAs('date', 'A', 'CDEFGJHA!');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testSayAsDateFormatValid()
    {
        foreach (Alexa::SAY_AS_DATE_FORMATS as $format) {
            $ssml = SsmlBuilder::factory()->sayAs('date', 'A', $format);
            $spec = new Alexa();
            $spec->validate($ssml);
            static::addToAssertionCount(1);
        }
    }

    /**
     * @expectedException  \Techworker\Ssml\Specification\Exception\InvalidAttributeValueException
     * @expectedExceptionMessageRegExp /attribute role/
     */
    public function testWordRoleInvalid()
    {
        $ssml = SsmlBuilder::factory()->word('foo', 'foo');
        $spec = new Alexa();
        $spec->validate($ssml);
    }

    public function testWordRoleValid()
    {
        foreach (Alexa::WORD_ROLES as $role) {
            $ssml = SsmlBuilder::factory()->word($role, 'A');
            $spec = new Alexa();
            $spec->validate($ssml);
            static::addToAssertionCount(1);
        }
    }
}
