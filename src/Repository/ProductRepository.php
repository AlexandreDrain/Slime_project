<?php
namespace App\Repository;

use App\Entity\Produit;
use App\Utilities\Database;
use App\Utilities\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    public const TABLE_NAME = 'produit';
    public const ENTITY_NAME = Produit::class;
}
