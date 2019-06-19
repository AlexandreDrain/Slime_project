<?php

namespace App\Controller;

use App\Utilities\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AbstractController
{
    public function register(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->twig->render($response, 'connexion/register.twig');
    }

    public function connect(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->twig->render($response, 'connexion/connect.twig');
    }
    public function test(ServerRequestInterface $request, ResponseInterface $response)
    {
        $idMinAbs = 0;
        $tab = [12,-5,67,-99,-110,2,25,-45]; // On a notre tableau remplie de valeur aléatoire
        for ($i=1; $i < count($tab); $i++) { // On fait un boucle afin que chaque index du tableau soit vérifié
            if (abs($tab[$i]) < abs($tab[$idMinAbs])) { // On fait une condition
                // afin de comparé la valeur absolue du chiffre
                // a un index par rapport a la valeur absolue de $idMinAbs
                $idMinAbs = $i; // Dans le cas ou la condition est vérifiéon stock le résultat
            }
        }

        return $this->twig->render(
            $response,
            '/testValeurAbs.twig',
            ['idMinAbs' => $tab[$idMinAbs]]
        ); // On envoie le tout a notre page "view",
        // attention a bien envoyer $tab[$idMinAbs] et non pas juste $idMinAbs
    }
}
