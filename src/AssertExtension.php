<?php

namespace Oppodelldog\TwigExtension\Assert;

use Twig_Extension;

class AssertExtension extends Twig_Extension
{
    public function getLoader()
    {
        return new class()
        {
            public function load($metaType, $parameters = [])
            {
                return [
                    'metaType' => $metaType,
                    'parameters' => $parameters,
                ];
            }
        };
    }

    public function getTokenParsers(): array
    {
        return [new AssertTokenParser()];
    }

    public function getName(): string
    {
        return self::class;
    }
}