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

namespace Techworker\Ssml\Tests\Iterator\Element;

use Techworker\Ssml\SsmlBuilder;
use Techworker\Ssml\Tests\TestCase;

class DomTest extends TestCase
{
    public function testIterating()
    {
        $expected = [
            [XML_ELEMENT_NODE, 'speak'],
            [XML_ELEMENT_NODE, 'p'],
            [XML_TEXT_NODE, 'foo'],
            [XML_TEXT_NODE, 'aaa'],
            [XML_ELEMENT_NODE, 'break'],
            [XML_ELEMENT_NODE, 'audio'],
            [XML_TEXT_NODE, 'dsdasda'],
            [XML_ELEMENT_NODE, 'p'],
            [XML_TEXT_NODE, 'ola']
        ];

        $p = SsmlBuilder::factory()->p('foo')->text('aaa')->brk()->audio('aaa')->text('dsdasda')->p('ola')->root();
        foreach ($p->getDomIterator() as $k => $domNode) {
            $expectedNode = array_shift($expected);
            self::assertEquals($expectedNode[0], $domNode->nodeType);
            if ($domNode->nodeType === XML_ELEMENT_NODE) {
                self::assertEquals($expectedNode[1], $domNode->nodeName);
            }
            if ($domNode->nodeType === XML_TEXT_NODE) {
                self::assertEquals($expectedNode[1], $domNode->textContent);
            }
        }
    }
}
