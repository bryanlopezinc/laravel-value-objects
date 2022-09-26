<?php

declare(strict_types=1);

namespace Olsza\ValueObjects\Tests\Feature\ValueObjects;

use MichaelRubel\ValueObjects\Collection\Primitive\Text;

test('text can accept integer', function () {
    $valueObject = new Text(1);
    $this->assertSame('1', $valueObject->value());
    $valueObject = new Text(2);
    $this->assertSame('2', $valueObject->value());
});

test('text can accept string', function () {
    $valueObject = new Text('1');
    $this->assertSame('1', $valueObject->value());
    $valueObject = new Text('1.2');
    $this->assertSame('1.2', $valueObject->value());
    $valueObject = new Text('1.3');
    $this->assertSame('1.3', $valueObject->value());
    $valueObject = new Text('1.7');
    $this->assertSame('1.7', $valueObject->value());
    $valueObject = new Text('1.8');
    $this->assertSame('1.8', $valueObject->value());
    $valueObject = new Text('2');
    $this->assertSame('2', $valueObject->value());
    $valueObject = new Text('3.1');
    $this->assertSame('3.1', $valueObject->value());
});

test('text can accept long text', function () {
    $text = new Text('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
    $this->assertSame('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', $text->value());
    $string = "
        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
        The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
        Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
        Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
    ";
    $text = new Text($string);
    $this->assertSame($string, $text->value());
});

test('text can accept float', function () {
    $valueObject = new Text(1.2);
    $this->assertSame('1.2', $valueObject->value());
    $valueObject = new Text(1.3);
    $this->assertSame('1.3', $valueObject->value());
    $valueObject = new Text(1.7);
    $this->assertSame('1.7', $valueObject->value());
    $valueObject = new Text(1.8);
    $this->assertSame('1.8', $valueObject->value());
    $valueObject = new Text(2.1);
    $this->assertSame('2.1', $valueObject->value());
});

test('text can accept null', function () {
    $valueObject = new Text(null);
    $this->assertSame('', $valueObject->value());
});

test('text fails when no argument passed', function () {
    $this->expectException(\TypeError::class);

    new Text;
});

test('integer is makeable', function () {
    $valueObject = Text::make(1);
    $this->assertSame('1', $valueObject->value());
    $valueObject = Text::make(1.1);
    $this->assertSame('1.1', $valueObject->value());
    $valueObject = Text::make('1');
    $this->assertSame('1', $valueObject->value());
    $valueObject = Text::make(null);
    $this->assertSame('', $valueObject->value());
});

test('integer is macroable', function () {
    Text::macro('getLength', function () {
        return str($this->value())->length();
    });
    $valueObject = new Text(12.3);
    $this->assertSame(4, $valueObject->getLength());
});

test('integer is conditionable', function () {
    $valueObject = new Text('1');
    $this->assertSame('1', $valueObject->when(true)->value());
    $this->assertSame($valueObject, $valueObject->when(false)->value());
});

test('integer is arrayable', function () {
    $array = (new Text(1))->toArray();
    $this->assertSame(['1'], $array);
});

test('integer is stringable', function () {
    $valueObject = new Text(1);
    $this->assertSame('1', (string) $valueObject);
    $valueObject = new Text(1.2);
    $this->assertSame('1.2', (string) $valueObject);
    $valueObject = new Text(1.3);
    $this->assertSame('1.3', (string) $valueObject);
    $valueObject = new Text(1.7);
    $this->assertSame('1.7', (string) $valueObject);
    $valueObject = new Text(1.8);
    $this->assertSame('1.8', (string) $valueObject);
});
