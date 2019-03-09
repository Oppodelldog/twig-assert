<?php

use Oppodelldog\TwigExtension\Assert\AssertExtension;
use Oppodelldog\TwigExtension\Assert\Tests\Playground\ViewModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . "/../../vendor/autoload.php";


$loader = new FilesystemLoader('templates');
$twig = new Environment($loader, ['cache' => 'data', 'debug' => true]);
$twig->addExtension(new AssertExtension());
$twig->enableStrictVariables();
$twig->enableDebug();

try {
    $template = $twig->load('index.twig');
} catch (Twig_Error_Loader $e) {
} catch (Twig_Error_Runtime $e) {
} catch (Twig_Error_Syntax $e) {
}

echo $template->render(['my_view_variable' => new ViewModel()]);