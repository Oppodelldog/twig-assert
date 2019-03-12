<?php

namespace Oppodelldog\TwigExtension\Assert\Tests;

use Oppodelldog\TwigExtension\Assert\AssertExtension;
use Oppodelldog\TwigExtension\Assert\AssertTokenParser;
use PHPUnit\Framework\TestCase;

class AssertExtensionTest extends TestCase
{
    public function testGetLoader()
    {
        $metaType = "meta-type";
        $parameters = ["p1" => true];
        $ext = new AssertExtension();
        $res = $ext->getLoader()->load($metaType, $parameters);

        self::assertEquals([
            'metaType' => $metaType,
            'parameters' => $parameters,
        ], $res);
    }

    public function testGetTokenParsers()
    {
        $ext = new AssertExtension();
        self::assertEquals([new AssertTokenParser()], $ext->getTokenParsers());
    }

    public function testGetName()
    {
        $ext = new AssertExtension();
        self::assertSame('Oppodelldog\TwigExtension\Assert\AssertExtension', $ext->getName());
    }
}
