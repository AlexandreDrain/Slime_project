<?php
namespace App\Utilities;

use Slim\Views\Twig;

abstract class AbstractController
{
    /**
     * @var Twig
     */
    protected $twig;

    /**
     * On demande la classe TWIG qui va nous permettre "d'appeler"
     * les vues TWIG dans le dossier "/templates"
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }
}
