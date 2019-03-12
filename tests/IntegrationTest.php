<?php

namespace Oppodelldog\TwigExtension\Assert;


use Oppodelldog\TwigExtension\Assert\Tests\TestViewModel;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class IntegrationTest extends TestCase
{
    private $testText1 = "This Text should be displayed";
    private $testText2 = "This Text should not be displayed";

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    function testParse()
    {
        $twig = new Environment($this->getTestLoader());
        $twig->addExtension(new AssertExtension());

        $html = $twig->render('test.twig', ['existing_variable' => new TestViewModel()]);

        self::assertContains($this->testText1, $html);
        self::assertNotContains($this->testText2, $html);
    }

    /**
     * @return ArrayLoader
     */
    public function getTestLoader(): ArrayLoader
    {
        $loader = new ArrayLoader();
        $loader->setTemplate('test.twig', /** @lang text */
            <<<TWIG
<h1>Test template</h1>
{% assert existing_variable "\\\\Oppodelldog\\\\TwigExtension\\\\Assert\\\\Tests\\\\TestViewModel" %}
$this->testText1

{% assert non_existing_variable "\\Oppodelldog\\TwigExtension\\Assert\\Tests\\TestViewModel" %}
$this->testText2
TWIG
        );
        return $loader;
    }
}
