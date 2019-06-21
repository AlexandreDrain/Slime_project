<?php
namespace App\Controller;

use App\Utilities\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Entity\Produit;
use App\Utilities\Database;
use Slim\Views\Twig;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(Twig $twig, ProductRepository $productRepository)
    {
        parent::__construct($twig);
        $this->productRepository = $productRepository;
    }

    /**
     * Affichage de tout les produits qui ont leur etat_publcation = 1
     * @param  ServerRequestInterface $request
     * @param  ResponseInterface      $response
     * @param  array                  $args
     * @return ResponseInterface
     */
    public function liste(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $products = $this->productRepository->findAll();
        // On renvoie les produits a la vue
        return $this->twig->render(
            $response,
            'product/list.twig',
            ['products' => $products]
        );
    }

    /**
     * Affichage du détail du produit
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $isPublished = 1;
        // Requête SQL
        $product = $this->productRepository->findBy([
            'id' => $args['id'],
            'etat_publication' => $isPublished
        ]);
        // On teste si un produit a été retourné
        if (empty($product)) {
            // Page d'erreur 404
            return $this->twig
                ->render($response, 'errors/error404.twig')
                ->withStatus(404)
            ;
        }
        return $this->twig->render($response, 'product/show.twig', [
            'product' => $product[0]
        ]);
    }
}
