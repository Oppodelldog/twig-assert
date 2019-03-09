<?php

namespace Oppodelldog\TwigExtension\Assert\Tests\Playground;

class ViewModel
{
    private $text = 'view model text';

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
