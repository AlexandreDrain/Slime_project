<?php
namespace App\Controller;

use App\Utilities\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Entity\Produit;
use App\Utilities\Database;

class ProductController extends AbstractController
{
    /**
     * Affichage de tout les produits qui ont leur etat_publcation = 1
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  array                  $args
     * @return ResponseInterface
     */
    public function liste(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // Requête SQL
        $query = "SELECT * FROM produit WHERE etat_publication = 1";
        // Exécution de la requête SQL et récupération des produits
        $products = $this->database->query($query, Produit::class);
        // On renvoie les produits a la vue
        return $this->twig->render(
            $response,
            'product/list.twig',
            ['products' => $products]
        );
    }

    /**
     * Affichage du détail du produit
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  array                  $args
     * @return ResponseInterface
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        // Requête SQL
        $query = "SELECT * FROM produit WHERE etat_publication = 1 AND id = ?";
        // Exécution de la requête SQL et récupération des produits
        $product = $this->database->queryPrepared($query, [$id], Produit::class);

        // On teste si un produit a été retourné
        if (empty($product)) {
            // Page d'erreur 404
            $response = $response->withStatus(404);
            return $this->twig->render($response, 'errors/error404.twig');
        }

        return $this->twig->render(
            $response,
            'product/show.twig',
            ['product' => $product[0]]
        );
    }
}
