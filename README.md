# techworker/ssml

This library allows you to easily generate Speech Synthesis Markup Language (SSML) with PHP.
 
## Usage

This library provides a fluent interface to build SSML strings. It tries to 
offer all elements that are defined in the specification, but since most of the 
synthesizers are satisfied with a "simple" SSML subset or some are bending the 
specification to it's own needs, this library does not force you into the 
specification and even offers you ways to go beyond the specification.
 
It ships with a SSML validator for Amazon Alexa.

*So in short:*

> You are able to generate the SSML that adhere's to the SSML specification, but it is simple to avoid the rules and generate what you need.

## Code peek

```php
<?php

echo $ssml = SsmlBuilder::factory()
    ->paragraph('My name is ')
        ->brk()
        ->text('Techworker.');
```
outputs
```xml
<speak>
    <p>My name is <break />Techworker.</p>
</speak>
```

## Installation

Add this to your `composer.json`

```json
"require": {
	"techworker/ssml": "^1.0"
}
```

.. or use the following command on your command line:

`composer require techworker/ssml`

After that, you can immediately start to build your SSML.


## The fluent interface

To get started, you'll have to create a new `speak` (root) element. This can be done in numerous ways, but the preferred way is to use the `\Techworker\Ssml\SsmlBuilder` class.

```php
$ssml = \Techworker\Ssml\SsmlBuilder::factory();
```

This will give you a new Element called `Speak` (which ends up as a `<speak>` node) and you can go on from here to add additional nodes.

To give you an example on how you can use the library:

```php
$ssml = \Techworker\Ssml\SsmlBuilder::factory();
$ssml->paragraph('My name is ')->brk()->text('Techworker');
```

This command will end up as:

```xml
<speak>
    <p>My name is <break />Techworker</p>
</speak>
```

There are two different types of elements. One element type is the 
container element. This is an element that can contain other elements.

The other type is a leaf element which is not capable of holding other elements
 as children.
 
If you add a container element with the fluent interface, you will get the 
container element itself back and can continue to add child elements to the 
container.

If you add a leaf element, you will get back the container element, that hosts
the previously added leaf element. So to fetch the leaf element, you'll have 
to call the `fetch` method.

**Example**

```php
<?php

$ssml = \Techworker\Ssml\SsmlBuilder::factory();

// paragraph is a container element that can host children
$paragraph = $ssml->paragraph('My name is ');

// break is a leaf element, so you need to fetch it immediately
// after adding it to get the elements instance
$break = $ssml->brk()->fetch();
```

There are 2 helper functions `up` and `root` to help you to traverse up in the 
element tree.

**Example**

```php
<?php

$ssml = \Techworker\Ssml\SsmlBuilder::factory();

// paragraph is a container element that can host children
$paragraph = $ssml->paragraph('My name is ');

// will both give you the speak element
$paragraph->up();
$paragraph->root(); // goes up to the root
```

## Supported Elements (tags)

SSML is used by various parties and some are just using a subset of the specification and some are extending the specification to it's needs. The following list describes the elements + attributes which are natively supported. Elements that are missing an attribute of your choice or are absent completely can still be created.

### speak

A SSML string is always surrounded by a `<speak>` tag. It will be created automatically, whenever you call the `\Techworker\Ssml\SsmlBuilder::factory();` method.

```php
echo \Techworker\Ssml\SsmlBuilder::factory();
// or
Speak::factory();
```

Outputs
```xml
<speak></speak>
```

### audio

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;
SsmlBuilder::factory()->audio('https://www.yourdomain.com/sound.mp3');
```

**Outputs**
```xml
<speak><audio src="https://www.yourdomain.com/sound.mp3"/></speak>
```

### break

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->brk();
SsmlBuilder::factory()->brkTime('5s');
SsmlBuilder::factory()->brkStrength('medium');

// manual
$speak = Speak::factory();

$speak->addElement(Break_::factory());
$speak->addElement(Break_::factoryWithTime('5s'));
$speak->addElement(Break_::factoryWithStrength('medium'));
```

**Outputs**
```xml
<speak><break/></speak>
<!-- or -->
<speak><break strength="medium"/></speak>
<!-- or -->
<speak><break time="5s"/></speak>
```

### p (paragraph)

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->paragraph();
SsmlBuilder::factory()->paragraph('Text to speech');
SsmlBuilder::factory()->p();
SsmlBuilder::factory()->p('Text to speech');

// manual
$speak = Speak::factory();

$speak->addElement(Paragraph::factory());
$speak->addElement(Paragraph::factory()->text('Text to speech'));
```

**Outputs**
```xml
<speak><p></p></speak>
<!-- or -->
<speak><p>Text to speech</p></speak>
```
### s (sentence)

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->sentence();
SsmlBuilder::factory()->sentence('Text to speech');
SsmlBuilder::factory()->s();
SsmlBuilder::factory()->s('Text to speech');

// manual
$speak = Speak::factory();

$speak->addElement(Sentence::factory());
$speak->addElement(Sentence::factory()->text('Text to speech'));
```

**Outputs**
```xml
<speak><s></s></speak>
<!-- or -->
<speak><s>Text to speech</s></speak>
```

### phoneme

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->phoneme('ipa', 'pɪˈkɑːn', 'pecan');

// manual
$speak = Speak::factory();

$speak->addElement(Phoneme::factory('ipa', 'pɪ\ˈkɑːn', 'pecan'));
```

**Outputs**
```xml
<speak><phoneme alphabet="ipa" ph="pɪˈkɑːn">pecan</phoneme></speak>
```

### say-as

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->sayAs('characters', 'ABCDEF', null /* format */);

// manual
$speak = Speak::factory();
$speak->addElement(SayAs::factory('characters', 'ABCDEF', null /* format */));
```

**Outputs**
```xml
<speak><say-as interpret-as="characters" format="not_given">ABCDEF</say-as></speak>
```

The format attribute is empty if not provided or set to `null` .


### w (word)

**Example**
```php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->word('ivona:VB', 'read');

// manual
$speak = Speak::factory();
$speak->addElement(Word::factory('ivona:VB', 'read'));
```

**Outputs**
```xml
<speak><w role="ivona:VB">read</w></speak>
```

## Custom elements

If you need a custom element for a synthesizer that adds additional elements to 
the specification, you can simply create them.

**Example**
```php
<?php
use \Techworker\Ssml\SsmlBuilder;

// fluent
SsmlBuilder::factory()->custom('sing', [
   'lyrics' => file_get_contents('lyric.txt')
]);

// manual
$speak = Speak::factory();
$speak->addElement(Custom::factory('sing', [
    'lyrics' => file_get_contents('lyric.txt')
]));
```

**Outputs**
```xml
<speak><sing lyrics="Old mc donald had a farm"></sing></speak>
```

## Custom attributes

If you need to add another attribute to an element that is not supported yet,
you can use the `attr` function on the element.

**Example**
```php
<?php
use \Techworker\Ssml\SsmlBuilder;

// fluent for a container
SsmlBuilder::factory()->word('ivona:VB', 'read')->attr('mode', 'silent');
// fluent for a non-container element
SsmlBuilder::factory()->brk()->fetch()->attr('duration', '100ms');

```

**Outputs**
```xml
<speak><w role="ivona:VB" mode="silent">read</w></speak>
```

```xml
<speak><break duration="100ms" /></speak>
```

## Validation

To validate the resulting SSML against specifications from a vendor, you can
use specification validators.

This library ships with a Amazon Alexa validator.

```php
<?php
use \Techworker\Ssml\SsmlBuilder;
use \Techworker\Ssml\Specification\Alexa;

$ssml = SsmlBuilder::factory()->paragraph()->root(); //..whatever 

try
{
    (new Alexa)->validate($ssml);
} catch(\Techworker\Ssml\SsmlException $ex) {
    // invalid
}

```

Test packagist